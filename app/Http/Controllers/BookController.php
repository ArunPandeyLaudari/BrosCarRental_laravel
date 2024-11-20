<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\Selectpayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookController extends Controller
{
    public function stores(Request $request)
    {
        // Step 1: Validate the incoming request
        $request->validate([
            'selectpayments_id' => 'required|exists:selectpayments,id',
            
        ]);

        // Step 2: Find the Selectpayment by ID
        $book = Selectpayment::find($request->selectpayments_id);

        if (!$book) {
            return back()->withErrors('Selected payment method does not exist.');
        }

        // Step 3: Create a new booking
        $data = [
            'user_id' => $book->user_id,
            'car_id' => $book->car_id,
            'name' => $book->name,
            'price' => $book->price,
            'start_date' => $book->start_date,
            'end_date' => $book->end_date,
            'status' => 'Pending',
        ];
        

        $order = book::create($data);
        $selectpayment = Selectpayment::find($request->selectpayments_id);
        $selectpayment->delete();
       
    

        // Step 4: Redirect to eSewa Payment
        try {
            $product_code = 'EPAYTEST';
                $amount = $order->price;
                $tax_amount = 0;
                $total_amount = $amount + $tax_amount;
                $success_url = route('book.success');
                $failure_url = route('book.failure');
                $transaction_uuid = $order->id . '-' . time();
                $signed_field_names = 'total_amount,transaction_uuid,product_code';
                $secret_key = '8gBm/:&EnhH.1/q';

                $data_string = "total_amount={$total_amount},transaction_uuid={$transaction_uuid},product_code={$product_code}";

                $signature = base64_encode(hash_hmac('sha256', $data_string, $secret_key, true));

                return response()->json([
                    'product_code' => $product_code,
                    'amount' => $amount,
                    'tax_amount' => $tax_amount,
                    'total_amount' => $total_amount,
                    'success_url' => $success_url,
                    'failure_url' => $failure_url,
                    'transaction_uuid' => $transaction_uuid,
                    'signed_field_names' => $signed_field_names,
                    'signature' => $signature,
                ])->withHeaders([
                    'Content-Type' => 'text/html'
                ])->setStatusCode(200)->setContent(
                    '<html><body>' .
                        '<form id="esewaForm" action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">' .
                        '<input type="hidden" name="amount" value="' . $amount . '">' .
                        '<input type="hidden" name="tax_amount" value="' . $tax_amount . '">' .
                        '<input type="hidden" name="total_amount" value="' . $total_amount . '">' .
                        '<input type="hidden" name="transaction_uuid" value="' . $transaction_uuid . '">' .
                        '<input type="hidden" name="product_code" value="' . $product_code . '">' .
                        '<input type="hidden" name="product_service_charge" value="0">' .
                        '<input type="hidden" name="product_delivery_charge" value="0">' .
                        '<input type="hidden" name="success_url" value="' . $success_url . '">' .
                        '<input type="hidden" name="failure_url" value="' . $failure_url . '">' .
                        '<input type="hidden" name="signed_field_names" value="' . $signed_field_names . '">' .
                        '<input type="hidden" name="signature" value="' . $signature . '">' .
                        '</form>' .
                        '<script>document.getElementById("esewaForm").submit();</script>' .
                        '</body></html>'
                );
        } catch (\Exception $e) {
           
            dd("vai error aayo aabha k");
        }
    }


public function index()
{
    $orders = book::all();
    return view('users.pay', compact('orders'));
}

public function status($id, $status)
{
    $order = book::find($id);
    $order->status = $status;
    $order->save();
    //send email
    $data = [
        'name' => $order->user->name,
        'status' => $order->status,
    ];
    Mail::send('emails.orderemail', $data, function ($message) use ($order) {
        $message->to($order->user->email, $order->user->name)->subject('Your Order is now ' . $order->status );
    });

 
    return back()->with('success', 'Order status updated successfully');
}

public function success(Request $request)
{
    $data = $request->input('data');
    $decoded_data = json_decode(base64_decode($data), true);
   

    if (!$decoded_data) {
        return response()->json(['error' => 'Invalid data'], 400);
    }

   
    $booking_id = $decoded_data['transaction_uuid'];

    $booking = book::find($booking_id);
   
    if ($booking) {
        // Step 3: Update the booking status to 'Paid'
        $booking->status = 'Booked';
        $booking->paid='paid';

        $booking->save();
        

        // Step 4: Send a success message to the user
        return redirect()->route('users.index')->with('success', 'Payment successful! Room booked.');
    }

    return redirect()->route('users.index')->with('error', 'Payment failed.');
}

// Payment Failure
public function failure(Request $request)
{
    // You can log the failure details for troubleshooting if necessary

    return redirect()->route('home')->with('error', 'Payment failed.');
}
}
