@extends('layouts.user')

@section('content')

<div class="container mx-auto p-8 bg-white rounded-lg shadow-xl flex flex-col lg:flex-row gap-8 mt-14">

    <!-- Booking Details and Payment Method Selection Form -->
    <div class="w-full flex flex-col lg:flex-row gap-8">

        <!-- Left Side: Booking Details -->
        <div class="w-full lg:w-1/2 bg-gray-50 p-8 rounded-lg shadow-md">
            <h2 class="text-3xl font-semibold text-gray-800 mb-6">Booking Details</h2>

            <!-- User Info -->
            <div class="mb-8">
                <p class="text-lg font-semibold text-gray-600">Booked by: {{ auth()->user()->name }}</p>
                <p class="text-lg text-gray-600">Email: {{ auth()->user()->email }}</p>
            </div>

            <!-- Car Details -->
            <div class="flex items-center gap-6">
                <img src="{{ asset($car->photopath) }}" alt="Car Image" class="w-40 h-40 object-contain rounded-lg shadow-md">
                <div>
                    <p class="text-xl font-semibold text-gray-800">{{ $car->name }}</p>
                    <p class="text-lg text-gray-600">Price per day: <span class="text-green-500 font-semibold">Rs {{ number_format($car->price) }}</span></p>

                    <!-- Total Price Calculation -->
                    @php
                        $duration = \Carbon\Carbon::parse($selectpayments->first()->start_date)->diffInDays($selectpayments->first()->end_date) + 1;
                        $totalPrice = $duration * $car->price;
                    @endphp
                    <p class="text-lg font-semibold text-gray-600 mt-2">Total Price for {{ $duration }} days: <span class="text-green-500 font-semibold">Rs {{ number_format($totalPrice) }}</span></p>
                </div>
            </div>

            <!-- Booking Dates -->
            <div class="mt-4">
                <p class="text-lg text-gray-600">Start Date: {{ \Carbon\Carbon::parse($selectpayments->first()->start_date)->toFormattedDateString() }}</p>
                <p class="text-lg text-gray-600">End Date: {{ \Carbon\Carbon::parse($selectpayments->first()->end_date)->toFormattedDateString() }}</p>
            </div>
        </div>

        <!-- Right Side: Payment Method Selection -->
        <div class="w-full lg:w-1/2 bg-gray-50 p-6 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Select Payment Method</h1>

            <!-- Payment Method Selection Form -->
            <form action="{{ route('users.stores', $car->id) }}" method="POST">
                @csrf
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Choose a Payment Method</h2>

                <div class="flex flex-col space-y-4">
                    @foreach($paymentMethods as $method)
                        <label class="border rounded-lg p-4 flex items-center justify-start cursor-pointer transition-transform transform hover:scale-105 shadow-md hover:shadow-lg duration-300">
                            <input type="radio" name="payment_method" value="{{ $method['id'] }}" class="mr-4" required>
                            <span class="flex items-center text-gray-700">
                                @if($method['id'] == 1)  <!-- Assuming eSewa has id 1 -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" class="w-8 h-8 mr-4">
                                        <path d="M100 0C44.8 0 0 44.8 0 100s44.8 100 100 100 100-44.8 100-100S155.2 0 100 0zm0 185c-46.8 0-85-38.2-85-85S53.2 15 100 15s85 38.2 85 85-38.2 85-85 85zm43-104.4c-4.1-2.3-8.4-3.5-13-3.5-7.2 0-14.2 2.8-19.2 7.8l-5.1 5.2-5.1-5.2c-5-5-12-7.8-19.2-7.8-4.6 0-8.9 1.2-13 3.5-8.3 4.6-13.4 13.3-13.4 22.9 0 3.4.4 6.6 1.1 9.7 2.5 11.5 9.7 21.2 19.4 26.6 4.8 2.5 10.2 3.9 15.9 3.9s11.1-1.4 15.9-3.9c9.7-5.4 16.9-15.1 19.4-26.6.7-3.1 1.1-6.3 1.1-9.7 0-9.5-5.1-18.3-13.4-22.9z" fill="#F8A600"/>
                                    </svg>
                                @else
                                    <i class="{{ $method['icon'] }} text-2xl mr-3"></i> <!-- Use Font Awesome icons -->
                                @endif
                                <span class="text-lg font-medium">{{ $method['name'] }}</span>
                            </span>
                        </label>
                    @endforeach
                </div>

                <div class="mt-6 text-center">
                    <!-- Ensure $selectpayments is correctly referenced -->
                    @if($selectpayments->count() > 0)
                        <input type="hidden" name="selectpayments_id" value="{{ $selectpayments->first()->id }}">
                    @endif

                    <button type="submit" class="bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out transform hover:scale-105 shadow-md hover:shadow-lg">
                        Continue
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
