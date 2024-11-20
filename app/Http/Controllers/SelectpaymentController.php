<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Selectpayment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SelectpaymentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request
        $data = $request->validate([
            'car_id' => 'required|exists:cars,id', // Ensure car_id exists in the cars table
            'start_date' => 'required|date|after_or_equal:today', // Start date should be today or later
            'end_date' => 'required|date|after_or_equal:start_date', // End date should be after start date
        ]);
    
        // Fetch the car details using the provided car_id
        $car = Car::findOrFail($data['car_id']); 
        $user = auth()->user(); 
    
        // Calculate the duration and total price
        $startDate = Carbon::parse($data['start_date']);
        $endDate = Carbon::parse($data['end_date']);
        $duration = $startDate->diffInDays($endDate) + 1; 
        $totalPrice = $duration * $car->price; 
    
        // Prepare data for payment selection
        $selectpaymentdata = [
            'user_id' => $user->id, 
            'name' => $user->name,  
            'email' => $user->email, 
            'car_id' => $car->id, 
            'car_name' => $car->name, 
            'price' => $totalPrice, 
            'photopath' => $car->photopath, 
            'start_date' => $startDate, 
            'end_date' => $endDate, 
        ];
    
        // Insert into the selectpayments table
        $created = Selectpayment::create($selectpaymentdata);
    
        // Check if the data is created successfully
        if ($created) {
            $id = $car->id;
            return redirect()->route('users.selectpayment', compact('id'))
                ->with('success', 'Car successfully added.');
        } else {
            return redirect()->back()->with('error', 'Failed to add car.');
        }
    }


    public function selectpayment($id)
    {
        $paymentMethods = [
            ['id' => 1, 'name' => 'eSewa', 'icon' => 'fab fa-cc-esewa'],
            ['id' => 2, 'name' => 'PayPal', 'icon' => 'fab fa-cc-paypal'],
            ['id' => 3, 'name' => 'Bank Transfer', 'icon' => 'fas fa-university'],
            ['id' => 4, 'name' => 'Credit Card', 'icon' => 'fas fa-credit-card'],
        ];

        $user = Auth::user();

        // Fetch the currently selected car
        $car = Car::findOrFail($id); // Use findOrFail to ensure the car exists
        $selectpayments = Selectpayment::where('user_id', $user->id)
            ->where('car_id', $car->id) // Assuming you have the $carId variable defined
            ->get();


        return view('users.selectpayment', compact('user', 'selectpayments', 'paymentMethods', 'car'));
    }
}