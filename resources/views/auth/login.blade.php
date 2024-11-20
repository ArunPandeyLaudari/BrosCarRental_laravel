<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page | Bro's CAR RENTAL</title>
    <link rel="shortcut icon" href="{{ asset('img/weblogo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>

<body class="h-screen bg-purple-100">
    <div class="grid min-h-full grid-cols-1 md:grid-cols-2">
        <div class="relative">
            <a href="{{ route('home') }}"
                class="absolute z-10 px-2 py-3 text-white bg-blue-500 rounded-lg top-4 left-4 hover:bg-blue-900"><i
                    class="bx bx-home">Bro's CAR RENTAL</i></a>
            <img src="{{ asset('img/car.png') }}" alt="Login Image" class="object-cover w-full mt-40 h-100px">
        </div>
        <div class="flex items-center justify-center">
            <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
                <h2 class="mb-5 text-2xl font-bold text-center">Login to Bro's Car Rental</h2>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <input type="text" class="w-full p-2 mt-4 border border-gray-300 rounded-lg" placeholder="Email"
                        name="email">
                    @error('email')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                    <input type="password" class="w-full p-2 mt-4 border border-gray-300 rounded-lg"
                        placeholder="Password" name="password">
                    @error('password')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                    <div class="flex items-center justify-between mt-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" class="text-blue-500 rounded form-checkbox" name="remember">
                            <span class="ml-2 text-gray-700">Remember Me</span>
                        </label>
                        <a href="{{ route('password.request') }}" class="text-blue-500">Forgot Password?</a>
                    </div>
                    <button type="submit"
                        class="w-full py-2 mt-4 text-white transition-colors bg-blue-500 rounded-lg hover:bg-blue-900">Login</button>
                </form>
                <p class="mt-4 text-center">
                    Don't have an account? <a href="{{ route('register') }}" class="text-blue-500">Register</a>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
