@extends('layouts.user')
@section('content')

<div class="container mx-auto px-4 py-8 mt-24">
    <h2 class="font-bold text-4xl text-amber-600 mb-6">Edit User</h2>
    <hr class="h-1 bg-amber-600 mb-8">

    <div class="bg-white shadow-md rounded-lg p-8">
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" class="border p-3 w-full rounded-lg focus:ring-amber-600 focus:border-amber-600" placeholder="Enter name" value="{{ old('name', $user->name) }}">
                @error('name')
                    <span class="text-red-500 mt-2 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="border p-3 w-full rounded-lg focus:ring-amber-600 focus:border-amber-600" placeholder="Enter email" value="{{ old('email', $user->email) }}">
                @error('email')
                    <span class="text-red-500 mt-2 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label for="phonenumber" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" id="phonenumber" name="phonenumber" class="border p-3 w-full rounded-lg focus:ring-amber-600 focus:border-amber-600" placeholder="Enter phone number" value="{{ old('phonenumber', $user->phonenumber) }}">
                @error('phonenumber')
                    <span class="text-red-500 mt-2 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label for="photopath" class="block text-sm font-medium text-gray-700">Current Picture</label>
                @if($user->photopath)
                    <div class="mb-4">
                        <img src="{{ asset('uploads/users/' . $user->photopath) }}" alt="Current Profile Picture" class="h-20 w-20  object-cover">
                    </div>
                @endif
                <input type="file" id="photopath" name="photopath" class="border p-3 w-full rounded-lg focus:ring-amber-600 focus:border-amber-600">
                @error('photopath')
                    <span class="text-red-500 mt-2 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-center gap-5 mt-8">
                <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white py-3 px-8 rounded-lg transition ease-in-out duration-150">Update</button>
                <a href="{{ route('users.profile', $user->id) }}" class="bg-gray-500 hover:bg-gray-600 text-white py-3 px-7 rounded-lg transition ease-in-out duration-150">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection
