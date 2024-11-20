@extends('layouts.app')
@section('content')
    <h2 class="font-bold text-3xl text-amber-600">Edit users</h2>
    <hr class="h-1 bg-amber-600">

    <div class="mt-10">
        <form action="{{route('useradmin.update',$user->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
          
            <div class="mb-5">
                <input type="text" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="name name" name="name" value="{{$user->name}}">
                @error('name')
                    <div class="text-red-500 mt-2 text-sm">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="mb-5">
                <textarea name="email" id="" cols="30" rows="5" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="Email">{{$user->email}}</textarea>
                @error('email')
                    <div class="text-red-500 mt-2 text-sm">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-5">
                <input type="text" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="Phone No" name="phonenumber" value="{{$user->phonenumber}}">
                @error('phonenumber')
                    <div class="text-red-500 mt-2 text-sm">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <p>Current Picture</p>
            <img src="{{asset('uploads/users/'.$user->photopath)}}" class="w-56" alt="">
            <div class="mb-5">
                <input type="file" class="w-full p-3 border border-gray-300 rounded-lg" name="photopath">
                @error('photopath')
                    <div class="text-red-500 mt-2 text-sm">
                        {{$message}}
                    </div>
                 @enderror
            </div>
            

            <div class="mb-5 flex gap-5 justify-center">
                <button class="bg-amber-600 text-white p-3 rounded-lg">Update User</button>
                <a href="{{route('useradmin.index')}}" class="bg-gray-600 text-white p-3 rounded-lg">Cancel</a>
            </div>
        </form>
    </div>


@endsection