@extends('layouts.app')

@section('content')

<div class="mx-auto max-w-screen-xl rounded-lg shadow-lg p-8 m-8 mt-5 bg-white">
    <div class="flex md:flex-row flex-col">

        {{-- -------------------------------------------- left -------------------------------------------- --}}
        <div class="md:w-2/3 p-6 border-r border-gray-200">
            <h2 class="font-semibold text-5xl md:text-6xl text-gray-800">{{ $car->name }}</h2>

            <div class="flex items-center mt-6">
                <h3 class="text-gray-700 text-2xl">Price:</h3>
                <p class="text-4xl font-semibold text-green-700 ms-3">Rs. {{ number_format($car->price) }} </p><p class="text-3xl font-semibold text-gray-700 ms-3">per Day</p>
            </div>

            <div class="flex items-center mt-6">
                <h3 class="text-gray-700 text-2xl">Availability:</h3>
                <p class="text-2xl font-semibold text-green-700 ms-3">{{ $car->availability ? 'Available' : 'Not Available' }}</p>
            </div>

            <div class="mt-6">
                <h4 class="text-lg font-medium text-gray-700">Description:</h4>
                <p class="mt-2 text-gray-600">{{ $car->description }}</p>
            </div>
{{-- 
            <div class="mt-8">
                <h4 class="text-lg font-medium text-gray-700">Additional Details:</h4>
                <ul class="mt-2 text-gray-600 list-disc list-inside">
                    <li><strong>Brand:</strong> {{ $car->brand }}</li>
                    <li><strong>Year:</strong> {{ $car->year }}</li>
                    <li><strong>Mileage:</strong> {{ number_format($car->mileage) }} km</li>
                </ul>
            </div> --}}
        </div>

        {{-- -------------------------------------------- right -------------------------------------------- --}}
        <div class="md:w-1/3 flex flex-col items-center p-6">
            <div class="relative w-full h-64 overflow-hidden rounded-lg shadow-lg">
                <img loading="lazy" class="h-full w-full object-contain" src="{{ asset($car->photopath) }}" alt="{{ $car->name }}" />
            </div>
        </div>
    </div>
</div>

@endsection
