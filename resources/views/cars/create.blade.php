@extends('layouts.app')
@section('content')
   <h2 class="font-bold text-3xl text-amber-600">Add Cars</h2>
    <hr class="h-1 bg-amber-600">

    <div class="mt-10">
        <form action="{{route('cars.store')}}" method="post"  enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <input type="text" class="border p-3 w-full rounded-lg" name="car_no" placeholder=" Car_no" value="{{old('car_no')}}">
                @error('name')
                    <div class="text-red-500 mt-2 text-sm">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <input type="text" class="border p-3 w-full rounded-lg" name="name" placeholder=" Name" value="{{old('name')}}">
                @error('name')
                    <div class="text-red-500 mt-2 text-sm">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <input type="text" class="border p-3 w-full rounded-lg" name="description" placeholder="Description" value="{{old('description')}}">
                @error('priority')
                    <div class="text-red-500 mt-2 text-sm">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <input type="text" class="border p-3 w-full rounded-lg" name="price" placeholder="Price" value="{{old('price')}}">
                @error('priority')
                    <div class="text-red-500 mt-2 text-sm">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <input type="text" class="border p-3 w-full rounded-lg" name="availability" placeholder="Availability" value="{{old('availability')}}">
                @error('priority')
                    <div class="text-red-500 mt-2 text-sm">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <input type="file" class="border p-3 w-full rounded-lg" name="photopath" placeholder="image" value="{{old('photopath')}}">
                @error('priority')
                    <div class="text-red-500 mt-2 text-sm">
                        {{$message}}
                    </div>
                @enderror
            </div>
        

            <div class="flex justify-center gap-5">
                <button class="bg-blue-600 text-white py-3 px-10 rounded-lg">Save</button>
                <a href="{{route('cars.index')}}" class="bg-red-500 text-white py-3 px-7 rounded-lg">Cancel</a>
            </div>
        </form>
    </div> 
@endsection  