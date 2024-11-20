@extends('layouts.master')
@section('content')
    <!-- Home -->
    <section class="container pt-16 mx-auto home" id="home">
        <div class="bg-purple-100 ">
            {{-- hero --}}
            <div class="flex justify-center max-w-screen-xl py-12 mx-auto md:py-28">
                <div class="flex flex-col justify-center mx-12 md:w-3/5 md:ms-20 md:mx-0">
                    <h1 class="mb-8 text-4xl font-bold text-center text-gray-900  md:text-start font-car md:text-7xl"><span
                            class="text-purple-400"> EASY
                        </span>AND
                        FAST WAY TO RENT YOUR CAR</h1>
                    <div class="md:w-3/5 md:hidden ">
                        <img loading="lazy" src="{{ asset('img/Ford_Mustang.jpg/') }}" alt="home car">
                    </div>
                    <p class="mx-8 text-justify md:mx-0 ">Whether you're planning a weekend
                        getaway or a cross-district adventure, we've got you covered. With our wide selection of vehicles
                        and
                        convenient booking system, renting a car has never been this effortless.</p>
                    <div class="flex justify-center mt-12 md:justify-start md:w-2/3 me-12 md:-ms-12">
                        <a href="{{ route('car') }}">
                            <button
                                class="w-32 p-2 font-bold text-white bg-purple-400 border-2 border-white rounded-md hover:bg-purple-500 md:me-12 md:mx-12 mx-7 ">CARS</button>
                        </a>
                        <a href="{{ route('contact') }}">
                            <button
                                class="w-32 p-2 text-black border-2 border-purple-400 rounded-md hover:bg-purple-400">CONTACT
                                US</button>
                        </a>
                    </div>
                </div>
                <div class="hidden md:w-3/5 md:block">
                    <img loading="lazy" src="{{ asset('img/Ford_Mustang.jpg') }}"
                        class="rounded-[500px] w-11/12 h-auto mx-6" alt="home car">
                </div>

            </div>
    </section>
    <section class="container p-8 mx-auto sales" id="sales">
        <!-- Box Container -->
        <div class="grid gap-4 md:grid-cols-3">
            <!-- Box 1 -->
            <div
                class="p-4 transition-transform transform border rounded shadow box hover:scale-105 hover:shadow-lg hover:bg-gray-100">
                <img src="{{ asset('img/DCT.jpg') }}" alt="Dreams Come True">
                <h3 class="mb-2 text-2xl font-bold">Make Your Dream True</h3>
                <p>At SK CAR RENTAL, we believe that every journey begins with a dream...</p>
            </div>
            <!-- Box 2 -->
            <div
                class="p-4 transition-transform transform border rounded shadow box hover:scale-105 hover:shadow-lg hover:bg-gray-100">
                <img src="{{ asset('img/mem.jpg') }}" alt="Membership">
                <h3 class="mb-2 text-2xl font-bold">Start Your Membership</h3>
                <p>Welcome to the next level of car rental experience...</p>
            </div>
            <!-- Box 3 -->
            <div
                class="p-4 transition-transform transform border rounded shadow box hover:scale-105 hover:shadow-lg hover:bg-gray-100">
                <img src="{{ asset('img/eyr.jpg') }}" alt="Enjoy">
                <h3 class="mb-2 text-2xl font-bold">Enjoy Your Ride</h3>
                <p>Every turn, every stop, every mile – they all contribute to the tapestry of memories...</p>
            </div>
        </div>
    </section>

    <!-- Properties -->
    <section class="container py-16 mx-auto properties" id="properties">
        <div class="max-w-screen-xl mx-auto">
            <div class="flex justify-center align-middle">
                <hr class="mt-8 h-0.5 w-2/5 bg-pink-500">
                <p class="p-2 mx-8 my-2 text-lg font-bold font-car text-black-400">CARS</p>
                <hr class="mt-8 h-0.5 w-2/5 bg-pink-500">
            </div>
            <div class="flex justify-end mb-4 mr-4 md:mr-16">
                <a href="{{ route('car') }}">
                    <button
                        class="w-24 p-2 font-medium text-black transition duration-300 border-2 border-black rounded-md hover:bg-blue-400 hover:text-white">See
                        All</button>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-10 px-4 my-10 sm:grid-cols-2 lg:grid-cols-3 md:px-24">
            @foreach ($cars as $car)
                <div class="p-4 transition-transform transform rounded-lg shadow-lg hover:scale-105">
                    <img src="{{ asset($car->photopath) }}" alt="car" class="object-cover w-full h-48 rounded-t-lg">
                    <div class="p-4">
                        <h2 class="text-lg font-semibold md:text-xl">Car No: {{ $car->car_no }}</h2>
                        <h2 class="text-lg font-bold md:text-xl">{{ $car->name }}</h2>

                        <div class="flex items-center justify-between mt-4">
                            <span class="text-xl font-medium text-orange-500">Rs. {{ $car->price }}</span>
                            <a href="{{ route('login') }}">
                                <button
                                    class="px-4 py-2 text-white transition duration-300 bg-blue-500 rounded-lg hover:bg-blue-800">Book
                                    Now</button>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>



    <!-- About -->
    <section class="container about ">

        <body class="flex items-center justify-center min-h-screen bg-gray-100">
            <div class="flex flex-col mx-auto overflow-hidden bg-white rounded-lg shadow-lg md:flex-row">
                <img src="{{ asset('img/car.png') }}" alt="Car Image"
                    class="object-cover w-full h-auto rounded-lg md:w-1/2">
                <div class="p-8 md:w-1/2">
                    <h2 class="mb-4 text-3xl font-bold text-red-600">Hiring a car? You're at the right place.</h2>
                    <h3 class="mb-4 text-3xl font-semibold text-blue-700">Bro's Car Rental, तपाइको यात्राको सहयात्री।</h3>
                    <p class="mb-4 text-gray-600">Get yourself a best quality car at a best rate quoted anytime.</p>
                    <p class="mb-6 text-gray-600">We are Nepal's Largest Car Rental Company. With hundreds of fleets and
                        best customer service, we offer you the best of class service.</p>
                    <a href="{{ route('about') }}"
                        class="inline-block px-4 py-2 font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-600">Read
                        More</a>
                </div>
            </div>
    </section>
@endsection
