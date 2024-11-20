@extends('layouts.user')
@section('content')

<section class="mt-24">
    <div class="bg-gray-200 mx-auto max-w-screen-xl mt-10 p-6 rounded-md shadow-xl">
        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">Whoops!</strong> There were some problems with your input.
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Search Form -->
        <form action="{{ route('users.search') }}" method="GET">
            <div class="flex flex-col md:flex-row justify-center gap-6 md:gap-10">
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Brand Input -->
                    <input type="text" name="brand" value="{{ old('brand') }}" placeholder="Brand" class="block w-full md:w-auto px-4 py-2 rounded-md border border-gray-300 text-gray-900 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200">

                    <!-- Minimum Price Input -->
                    <input type="number" name="min_price" value="{{ old('min_price') }}" placeholder="Min Price (Rs.)" min="0" class="block w-full md:w-auto px-4 py-2 rounded-md border border-gray-300 text-gray-900 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200">

                    <!-- Maximum Price Input -->
                    <input type="number" name="max_price" value="{{ old('max_price') }}" placeholder="Max Price (Rs.)" min="0" class="block w-full md:w-auto px-4 py-2 rounded-md border border-gray-300 text-gray-900 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-200">
                </div>

                <!-- Search Button -->
                <button type="submit" class="w-full md:w-auto bg-blue-500 text-white font-medium rounded-md px-6 py-2 hover:bg-blue-600 transition duration-300">
                    Search
                </button>
            </div>
        </form>
    </div>
</section>

<!-- Results Section -->
<section>
    <div class="mx-auto max-w-screen-xl">
        <div class="flex align-middle justify-center">
            <hr class="mt-8 h-0.5 w-2/5 bg-pink-500">
            <p class="my-2 mx-8 p-2 font-car font-bold text-black-400 text-lg">CARS</p>
            <hr class="mt-8 h-0.5 w-2/5 bg-pink-500">
        </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 my-10 px-4 md:px-24">
        @foreach($cars as $car)
        <div class="p-2 rounded-lg shadow">
            <!-- Display car image -->
            <img src="{{ asset($car->photopath) }}" alt="car" class="w-full h-64 object-cover rounded-md">

            <div class="p-2">
                <!-- Car details -->
                <h2 class="text-xl font-semibold">Car No: {{$car->car_no}}</h2>
                <h2 class="text-xl font-bold">{{$car->name}}</h2>

                <!-- Car price and rent button -->
                <div class="flex justify-between items-center mt-4">
                    <span class="text-xl text-orange-500 font-medium">Rs. {{$car->price}}</span>
                    <form action="{{route('users.book',['id' => $car->id])}}" method="POST">
                        @csrf
                        <button class="bg-blue-500 hover:bg-blue-800 text-white px-2 py-1 rounded-lg">Book Now</button>
                    </form>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Pagination -->
<div class="flex justify-center my-4">
    {{ $cars->links() }}
</div>

@endsection

