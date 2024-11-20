@extends('layouts.user')

@section('content')
<section class="reservation container mx-auto py-12 mt-10" id="reservation">
    <!-- Check if there are any bookings -->
    @if($cars->isNotEmpty())
        <!-- Section Title -->
        <div class="flex justify-between items-center mb-12">
            <h2 class="text-4xl font-bold text-gray-900 border-b-4 border-blue-600 px-3 pb-3 mt-16">Your Reservations</h2>
        </div>

        <!-- Booking Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 px-6">
            @foreach($cars as $car)
                @if(isset($car->car))
                <!-- Reservation Card -->
                <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out overflow-hidden transform hover:scale-105">
                    <!-- Car Image -->
                    <img src="{{ asset($car->car->photopath) }}" alt="Car {{ $car->car->car_no }}" class="w-full h-52 object-cover rounded-t-lg">
                    
                    <!-- Car and Booking Details -->
                    <div class="p-6">
                        <!-- Car Details -->
                        <h2 class="text-2xl font-semibold text-gray-900 mb-3">Car No: {{ $car->car->car_no }}</h2>
                        <h2 class="text-lg text-gray-800 mb-4"><span class="font-bold">{{ $car->car->name }}</span></h2>
                        
                        <!-- Booking Details -->
                        <p class="text-sm text-gray-800 mb-2">Status: <span class="font-semibold text-xl text-green-600">{{ ucfirst($car->status) }}</span></p>

                        <!-- Display Start Date, End Date, and Duration -->
                        <p class="text-sm text-gray-800 mb-2">Start Date: <span class="font-medium">{{ \Carbon\Carbon::parse($car->start_date)->format('d M Y') }}</span></p>
                        <p class="text-sm text-gray-800 mb-2">End Date: <span class="font-medium">{{ \Carbon\Carbon::parse($car->end_date)->format('d M Y') }}</span></p>

                        @php
                            $startDate = \Carbon\Carbon::parse($car->start_date);
                            $endDate = \Carbon\Carbon::parse($car->end_date);
                            $duration = $startDate->diffInDays($endDate) + 1; // Include the end date as part of the duration
                        @endphp
                        <p class="text-sm text-gray-800 mb-4">Duration: <span class="font-medium">{{ $duration }} days</span></p>

                        <!-- Price and Action Button -->
                        <div class="flex justify-between items-center mt-6">
                            <span class="text-xl font-bold text-blue-600">Total Price: Rs. {{ number_format($car->price) }}</span>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
    @else
        <!-- No Bookings Message -->
        <div class="text-center py-16">
            <p class="text-red-600 font-semibold text-xl">You have no bookings at the moment.</p>
            <a href="{{ route('users.car') }}" class="inline-block mt-8 text-base font-medium text-white bg-blue-600 hover:bg-blue-700 py-3 px-8 rounded-lg transition-all duration-200">Browse Cars</a>
        </div>
    @endif
</section>
@endsection
