@extends('layouts.app')
@section('content')
    <h2 class="font-bold text-3xl text-center text-gray-800 mt-5">Users Details</h2>
    <hr class="h-0.5 bg-gray-300 mb-8">

    <div class="mt-10">
        <table class="w-full border">
            <thead>
                <tr class="bg-gray-200">
                    
                    <th class="border p-3">Name</th>
                    <th class="border p-3">Email</th>
                    <th class="border p-3">Phone</th>
                    <th class="border p-3">Image</th>
                    <th class="border p-3">Action</th>
                    
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="text-center">
                    
                    <td class="border p-3">{{ $user->name }}</td>
                    <td class="border p-3">{{ $user->email }}</td>
                    <td class="border p-3">{{ $user->phonenumber }}</td>
                    <td class="border p-3">
                        <img src="{{ asset('uploads/users/' . $user->photopath) }}" class="w-24" alt="{{ $user->name }}">
                    </td>
                    <td class="border p-3">
                        <a href="{{ route('useradmin.edit', $user->id) }}" class="bg-blue-500 text-white p-2 rounded-lg">Edit</a>
                        <form action="{{ route('useradmin.delete', $user->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white p-2 rounded-lg"
                                    onclick="return confirm('Are you sure you want to delete this user?');">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
