@extends('layouts.user')
@section('content')

<div class="container px-4 py-8 mt-24">
    <h2 class="font-bold text-4xl text-gray-800 mb-6 text-center">User Profile</h2>
    <hr class="h-1 bg-gray-300 mb-8">

    <!-- Profile Card Section -->
    <div class="bg-white border border-gray-200 rounded-2xl shadow-lg max-w-xl mx-auto p-8">
        <!-- Profile Image -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('uploads/users/' . $user->photopath) }}" alt="Profile Image" class="h-36 w-36 rounded-full object-cover shadow-md">
        </div>

        <!-- Divider -->
        <div class="border-t border-gray-300 w-3/4 mx-auto mb-6"></div>

        <!-- Profile Info -->
        <div class="profile-info text-center space-y-4">
            <h2 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h2>
            <h3 class="font-medium text-gray-800"> Email: {{ $user->email }}</h3>
            <h3 class="font-medium text-gray-800">Phone: {{ $user->phonenumber }}</h3>
        </div>

        <!-- Buttons -->
        <div class="mt-8 space-y-4 text-center">
            <!-- Edit Profile Button -->
            <a href="{{ route('users.edit', $user->id) }}" class="py-2 px-8 bg-amber-600 text-white rounded-full shadow-md hover:bg-amber-700 transition-colors font-semibold inline-block">
                Edit Profile
            </a>

            <!-- Back Button -->
            <a href="{{ route('users.index') }}" class="py-2 px-8 bg-gray-800 text-white rounded-full shadow-md hover:bg-gray-900 transition-colors font-semibold inline-block">
                Back
            </a>
        </div>
    </div>
</div>

@endsection
