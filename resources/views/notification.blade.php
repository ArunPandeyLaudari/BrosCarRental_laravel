@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-10">
    <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-8">Booking Notifications</h1>
    <hr class="h-0.5 bg-gray-300 mb-8">

    @if($notifications->isNotEmpty())
        <!-- Notification List -->
        <div class="space-y-4">
            @foreach($notifications as $booking)
                <div class="flex justify-between items-center bg-white px-6 py-4 rounded-lg shadow-sm hover:shadow-lg transition-shadow duration-300">
                    <!-- Left Section: User Info -->
                    <div class="flex items-center space-x-4">
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900">{{ $booking->user->name }} booked a car.</h2>
                            <!-- Display the time when the booking was made -->
                            <p class="text-sm text-gray-600">Booked at: {{ $booking->created_at->format('h:i A, M d, Y') }}</p>
                        </div>
                    </div>

                    <!-- Center Section: Booking Status -->
                    <div class="text-center">
                        <p class="text-sm text-gray-800">Booking Status: 
                            <span class="font-medium text-green-500">{{ $booking->status }}</span>
                        </p>
                    </div>

                    <!-- Right Section: View Details -->
                    <div>
                        <a href="{{route('notifications.details',$booking->id)}}" class="bg-blue-600 text-white text-sm font-medium px-5 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                            View Details
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="mt-20">
            <p class="text-red-700 text-center font-semibold text-xl">No Booking History Found.</p>
        </div>
    @endif
</div>

@endsection
