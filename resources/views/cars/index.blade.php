@extends('layouts.app')
@section('content')
    <h2 class="font-bold text-3xl text-center text-gray-800 mt-5">Car Details</h2>
    <hr class="h-0.5 bg-gray-300 mb-8">

    <div class="mt-10 text-right">
        <a href="{{route('cars.create')}}" class="bg-amber-600 text-white p-3 rounded-lg">Add Cars</a>
    </div>

    <div class="mt-10">
        <table class="w-full border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-3">Car no</th>
                    <th class="border p-3">Name</th>
                    <th class="border p-3">Price</th>
                    <th class="border p-3">Availability</th>
                    <th class="border p-3">Image</th>
                    <th class="border p-3">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($cars as $car)
                <tr class="text-center">
                    <td class="border p-3">{{ $car->car_no }}</td>
                    <td class="border p-3">{{ $car->name }}</td>
                    <td class="border p-3">{{ $car->price }}</td>
                    <td class="border p-3">{{ $car->availability ? 'Available' : 'Not Available' }}</td>
                    <td class="border p-3">
                        <img src="{{ asset($car->photopath) }}" class="w-24" alt="{{ $car->name }}">
                    </td>
                    <td class="border p-3">
                        <a href="{{ route('cars.edit', $car->id) }}" class="bg-blue-500 text-white p-2 rounded-lg">Edit</a>
                        <a href="{{ route('cars.delete', $car->id) }}" class="bg-red-500 text-white p-2 rounded-lg">Delete</a>
                        <a href="{{ route('cars.view', $car->id) }}" class="bg-green-500 text-white p-2 rounded-lg">View</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
