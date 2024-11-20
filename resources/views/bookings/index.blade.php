{{-- Yo paxi implement grna lai rakhya hai just a test --}}


@extends('layouts.user')
@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-6">Your Bookings</h2>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Car</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Pickup Date</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Dropoff Date</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr class="border-b">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $booking->car->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $booking->pickup_date }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $booking->dropoff_date }}</td>
                            <td class="px-6 py-4 text-sm">
                                <span
                                    class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                            @if ($booking->status == 'confirmed') bg-green-100 text-green-800
                            @elseif($booking->status == 'pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No bookings found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
