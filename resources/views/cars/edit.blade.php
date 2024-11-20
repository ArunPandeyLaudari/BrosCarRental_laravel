@extends('layouts.app')
@section('content')
<h2 class="font-bold text-3xl text-amber-600">Edit Cars</h2>
<hr class="h-1 bg-amber-600">

<div class="mt-10">
    <form action="{{route('cars.update',$car->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
      
        <div class="mb-5">
            <input type="text" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="Car No" name="car_no" value="{{$car->car_no}}">
            @error('car_no')
                <div class="text-red-500 mt-2 text-sm">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="mb-5">
            <input type="text" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="name name" name="name" value="{{$car->name}}">
            @error('name')
                <div class="text-red-500 mt-2 text-sm">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="mb-5">
            <textarea name="description" id="" cols="30" rows="5" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="cars Description">{{$car->description}}</textarea>
            @error('description')
                <div class="text-red-500 mt-2 text-sm">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="mb-5">
            <input type="text" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="Price" name="price" value="{{$car->price}}">
            @error('price')
                <div class="text-red-500 mt-2 text-sm">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <input type="text" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="availability" name="availability" value="{{$car->availability}}">
            @error('availability')
                <div class="text-red-500 mt-2 text-sm">
                    {{$message}}
                </div>
            @enderror
        </div>

        <p class="font-semibold text-gray-700 mb-2">Current Picture</p>
        <img src="{{ asset($car->photopath) }}" class="w-56 h-auto object-cover mb-4" alt="Current Car Picture">
        <div class="mb-5">
            <input type="file" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-amber-600 focus:border-amber-600" name="photopath">
            @error('photopath')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
            @enderror
        </div>
        

        <div class="mb-5 flex gap-5 justify-center">
            <button class="bg-amber-600 text-white p-3 rounded-lg">Update Product</button>
            <a href="{{route('cars.index')}}" class="bg-gray-600 text-white p-3 rounded-lg">Cancel</a>
        </div>
    </form>
</div>


@endsection