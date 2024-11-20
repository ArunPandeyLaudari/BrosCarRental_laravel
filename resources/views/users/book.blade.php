@extends('layouts.user')
@section('content')

<div class="mx-auto max-w-screen-xl rounded-md p-6 m-8 mt-20">
    <div class="flex justify-between md:flex-row flex-col">
        {{-- -------------------------------------------- left -------------------------------------------- --}}
        <div class="md:w-2/3 md:border-r border-gray-800 p-2">

            <h2 class="ms-4 max-w-full font-semibold md:text-6xl text-4xl">{{ $cars->name }}</h2>

            <div class="flex items-end mt-8 ms-4">
                <h3 class="text-gray-500 text-2xl">Price per day:</h3>
                <p>
                    <span class="text-3xl font-medium text-orange-600 ms-3 me-1 border border-blue-400 p-2 rounded-md">
                        Rs. {{ $cars->price }}
                    </span>
                </p>
            </div>

            <div class="flex items-center justify-around mt-10 me-10">
                <div class="w-1/5 md:w-1/3 h-[0.25px] bg-gray-500"> </div>
                <p>Order Information</p>
                <div class="w-1/5 md:w-1/3 h-[0.25px] bg-gray-500"> </div>
            </div>

            <div class="px-6 md:me-8">
                <form id="reservation_form" action="{{ route('users.store',$cars->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="user" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="car_id" value="{{ $cars->id }}">
                    <input type="hidden" name="price_per_day" value="{{ $cars->price }}">
                    <input type="hidden" name="total_price" id="total_price_input">
                    <input type="hidden" name="duration" id="duration_input">

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                        <div class="sm:col-span-3">
                            <label for="full-name" class="block text-sm font-medium leading-6 text-gray-900">Full Name</label>
                            <div class="mt-2">
                                <input type="text" name="full-name" id="full-name" value="{{ $user->name }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email</label>
                            <div class="mt-2">
                                <input type="text" name="email" id="email" value="{{ $user->email }}" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="start_date" class="block text-sm font-medium leading-6 text-gray-900">Start at</label>
                            <div class="mt-2">
                                <input type="date" name="start_date" id="start_date" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6" min="{{ \Carbon\Carbon::today()->toDateString() }}" />
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="end_date" class="block text-sm font-medium leading-6 text-gray-900">End at</label>
                            <div class="mt-2">
                                <input type="date" name="end_date" id="end_date" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-pr-400 sm:text-sm sm:leading-6" min="{{ \Carbon\Carbon::today()->toDateString() }}" />
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 md:flex hidden gap-4">
                        <button type="submit" id="submit_button" disabled class="text-white bg-blue-500 p-3 w-full rounded-lg font-bold hover:bg-blue-700 shadow-xl hover:shadow-none disabled:opacity-50">
                            Book Now
                        </button>
                        
                        <button type="button" onclick="history.back()" class="text-white bg-red-500 p-3 w-full rounded-lg font-bold hover:bg-red-700 shadow-xl hover:shadow-none">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- -------------------------------------------- right -------------------------------------------- --}}

        <div class="md:w-1/3 flex flex-col justify-start items-center">
            <div class="relative mx-3 mt-3 flex h-[200px] w-3/4 overflow-hidden rounded-xl shadow-lg">
                <img loading="lazy" class="h-full w-full object-cover" src="{{ asset($cars->photopath) }}" alt="product image" />
            </div>
            <p class="ms-4 max-w-full font-bold text-xl mt-3 md:block hidden">{{ $cars->name }}</p>

            <div class="w-full mt-8 ms-8">
                <p id="duration" class="font-car text-gray-600 text-lg ms-2">Duration: <span class="mx-2 f text-md font-medium text-gray-700 border border-blue-400 p-2 rounded-md">X days</span>
                </p>
            </div>

            <div class="w-full mt-8 ms-8">
                <p id="total-price" class="font-car text-gray-600 text-lg ms-2">Total Price: <span class="mx-2 font-car text-md font-medium text-gray-700 border border-blue-400 p-2 rounded-md">Rs. Y</span>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Related Cars Section -->
<h1 class="text-3xl font-bold text-center mb-5 mt-10">Recommended Cars</h1>
<hr class="h-0.5 bg-gray-300 mb-8">

<section class="properties container mx-auto" id="properties">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12 px-8">
        @if($relatedCars->isEmpty())
            <div class="flex justify-center items-center w-full col-span-full">
                <p class="text-red-700 mb-10 text-center">No similar cars found in this price range.</p>
            </div>
        @else
            @foreach($relatedCars as $related)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition duration-300">
                    <img src="{{ asset($related->photopath) }}" alt="car" class="w-full h-64 object-cover rounded-t-lg">
                    <div class="p-5">
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $related->name }}</h2>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-semibold text-orange-500">Rs. {{ number_format($related->price) }}</span>
                            <!-- Form to make POST request for booking -->
                            <form action="{{ route('users.book', $related->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="car_id" value="{{ $related->id }}">
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                                    Book Now
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</section>
<br>

<script>
    // Fetch the price per day from the blade file (cars->price)
    const pricePerDay = {{ $cars->price }};
    const submitButton = document.getElementById('submit_button');

    document.getElementById('start_date').addEventListener('change', calculateDurationAndPrice);
    document.getElementById('end_date').addEventListener('change', calculateDurationAndPrice);

    function calculateDurationAndPrice() {
        const startDate = new Date(document.getElementById('start_date').value);
        const endDate = new Date(document.getElementById('end_date').value);

        if (startDate) {
            document.getElementById('end_date').setAttribute('min', document.getElementById('start_date').value);
        }

        if (startDate && endDate) {
            if (startDate <= endDate) {
                submitButton.disabled = false;

                const timeDifference = endDate - startDate;
                const daysDifference = timeDifference / (1000 * 3600 * 24) + 1;

                const totalPrice = daysDifference * pricePerDay;

                document.getElementById('duration').querySelector('span').innerText = `${daysDifference} days`;
                document.getElementById('total-price').querySelector('span').innerText = `Rs. ${totalPrice.toLocaleString()}`;

                document.getElementById('total_price_input').value = totalPrice;
                document.getElementById('duration_input').value = daysDifference;
            } else {
                submitButton.disabled = true;
                alert('End date must be after the start date.');
            }
        }
    }
</script>

@endsection
