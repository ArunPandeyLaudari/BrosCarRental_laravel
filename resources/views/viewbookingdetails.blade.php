@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-12">
    <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">Booking Details</h1>
    <hr class="h-0.5 bg-gray-300 mb-8">

    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-gray-900 mb-4">{{ $booking->user->name }}'s Booking Details</h2>

        <!-- Booking Details Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Car Details -->
            <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                <h3 class="font-semibold text-gray-800 underline mb-2">Car Information</h3>
                <p class="text-gray-600">Car Model: <span class="font-medium text-gray-800">{{ $booking->car->name }}</span></p>

                @if($booking->car->photopath)
                <img src="{{ asset($booking->car->photopath) }}" alt="Car Image" class="w-full h-56 object-cover rounded-lg shadow-md mt-2">
                @else
                <p class="text-red-500 mt-2">No image available for this car.</p>
                @endif
            </div>

            <!-- Booking Information -->
            <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                <h3 class="font-semibold text-gray-800 underline mb-2">Booking Information</h3>
                <p class="text-gray-600">Booking Status: <span class="font-semibold text-green-600">{{ $booking->status }}</span></p>
                <p class="text-gray-600">Booked At: <span class="font-medium text-gray-800">{{ $booking->created_at->format('M d, Y h:i A') }}</span></p>
                <p class="text-gray-600">Start Date: <span class="font-medium text-gray-800">{{ $booking->start_date->format('M d, Y') }}</span></p>
                <p class="text-gray-600">End Date: <span class="font-medium text-gray-800">{{ $booking->end_date->format('M d, Y') }}</span></p>
                <p class="text-gray-600">Duration: <span class="font-medium text-gray-800">{{ $booking->start_date->diffInDays($booking->end_date) }} days</span></p>
                <p class="text-gray-600">Price: <span class="font-medium text-gray-800">Rs.{{ number_format($booking->price, 2) }}</span></p>
            </div>
        </div>

        <!-- Additional Notes -->
        <div class="mt-6 bg-gray-100 p-6 rounded-lg shadow-md">
            <h3 class="font-semibold text-gray-800">Additional Notes</h3>
            <p class="text-gray-600">{{ $booking->notes ?? 'No additional notes provided.' }}</p>
        </div>

        <!-- Back Button -->
        <div class="mt-8 text-center">
            <a href="{{ route('notification') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">Back to Booking History</a>
        </div>
    </div>
</div>

@endsection
