<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bro's CAR RENTAL</title>
    <link rel="shortcut icon" href="{{ asset('img/weblogo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Add this for smoother transitions */

        .transition-all {
            transition: all 0.3s ease;
        }

        .footer-line {
            border-top: 1px solid gray;
            margin-top: 1px;
        }

        .back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
            background-color: #007BFF;
            /* Specific blue color */
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 24px;
            line-height: 50px;
            text-align: center;
            cursor: pointer;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }

        .back-to-top:hover {
            background-color: #0056b3;
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="font-sans text-gray-900 bg-gray-100">

    <!-- Navbar -->
    <header class="bg-white">
        <nav class="fixed top-0 left-0 z-50 w-full bg-gray-100 shadow-md">
            <div class="container flex items-center justify-between px-4 py-4 mx-auto md:px-0">
                <!-- Logo -->
                <a href="{{ route('users.index') }}"> <img src="{{ asset('img/logoo.png') }}" alt="CarRental Logo"
                        class="h-16"></a>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-button" class="text-black hover:text-blue-500 focus:outline-none">
                        <i class='text-3xl bx bx-menu'></i>
                    </button>
                </div>

                <!-- Navigation Links -->
                <ul id="nav-links" class="items-center hidden gap-10 md:flex">
                    <li>
                        <a href="{{ route('users.index') }}"
                            class="flex items-center space-x-1 font-bold text-black  text-1xl hover:text-blue-500">
                            <i class='bx bx-home'></i>
                            <span>Home</span>

                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.about') }}"
                            class="flex items-center space-x-1 font-bold text-black text-1xl hover:text-blue-500">
                            <i class='bx bx-user'></i>
                            <span>About Us</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.services') }}"
                            class="flex items-center space-x-1 font-bold text-black text-1xl hover:text-blue-500">
                            <i class='bx bx-cog'></i>
                            <span>Our Services</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.contact') }}"
                            class="flex items-center space-x-1 font-bold text-black text-1xl hover:text-blue-500">
                            <i class='bx bx-envelope'></i>
                            <span>Contact Us</span>
                        </a>
                    </li>
                </ul>

                <!-- Login Button and Dropdown -->
                <div class="relative inline-block mr-8 text-left">
                    <!-- Dropdown trigger image -->
                    <img id="dropdownDefaultButton" src="{{ asset('uploads/users/' . $user->photopath) }}"
                        alt="Dropdown trigger" class="w-10 h-10 rounded-full cursor-pointer">
                    <!-- Dropdown menu -->
                    <div id="dropdown"
                        class="absolute right-0 z-10 hidden mt-2 bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-500 dark:text-gray-200"
                            aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="{{ route('users.profile', ['id' => $user->id]) }}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Profile</a>
                            </li>
                            <li><a href="{{ route('users.reservations') }}"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">My
                                    Bookings</a>
                            </li>
                            <form action="{{ route('logout') }}" method="POST"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                @csrf
                                <button type="submit" class="inline">Logout</button>
                            </form>

                        </ul>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden transition-all bg-gray-100 shadow-md md:hidden">
                <ul class="flex flex-col items-center py-4 space-y-4">
                    <li>
                        <a href="{{ route('users.index') }}"
                            class="flex items-center space-x-1 font-bold text-black text-1xl hover:text-blue-500">
                            <i class='bx bx-home'></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.about') }}"
                            class="flex items-center space-x-1 font-bold text-black text-1xl hover:text-blue-500">
                            <i class='bx bx-user'></i>
                            <span>About Us</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.services') }}"
                            class="flex items-center space-x-1 font-bold text-black text-1xl hover:text-blue-500">
                            <i class='bx bx-cog'></i>
                            <span>Our Services</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.contact') }}"
                            class="flex items-center space-x-1 font-bold text-black text-1xl hover:text-blue-500">
                            <i class='bx bx-envelope'></i>
                            <span>Contact Us</span>
                        </a>
                    </li>

                </ul>
            </div>
        </nav>
    </header>

    <script>
        // Toggle mobile menu visibility
        document.getElementById('mobile-menu-button').onclick = function() {
            var menu = document.getElementById('mobile-menu');
            if (menu.classList.contains('hidden')) {
                menu.classList.remove('hidden');
            } else {
                menu.classList.add('hidden');
            }
        }
        // Toggle Dropdown Menu
        document.getElementById('dropdownDefaultButton').addEventListener('click', function() {
            var dropdown = document.getElementById('dropdown');
            if (dropdown.classList.contains('hidden')) {
                dropdown.classList.remove('hidden');
            } else {
                dropdown.classList.add('hidden');
            }
        });

        // Hide Dropdown when clicking outside
        document.addEventListener('click', function(event) {
            var dropdownButton = document.getElementById('dropdownDefaultButton');
            var dropdown = document.getElementById('dropdown');
            if (!dropdownButton.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>


    @yield('content')

    <!-- Footer -->
    <footer class="py-8 text-white bg-gray-900">
        <div class="container grid grid-cols-1 gap-8 px-4 mx-auto md:grid-cols-2 lg:grid-cols-5 md:px-0">
            <!-- About Us -->
            <div class="lg:col-span-2">
                <h3 class="mb-2 ml-5 font-bold">About Us</h3>
                <p class="ml-5 text-gray-400">
                    Established in 2023, Bro's CAR RENTAL stands as Nepal's best CAR rental company, offering an
                    unparalleled experience in travel. We are The Nepal's Largest Car Rental Company. With 100s of
                    fleets and best customer service. We offer you the best of class service. Remember us for anytime,
                    anywhere to rent a car and drive yourself anywhere.
                </p>
            </div>
            <!-- Contact Info -->
            <div>
                <h3 class="mb-2 font-bold">Contact Info</h3>
                <ul class="text-gray-400 ">
                    <li class="flex items-center mb-3 hover:text-blue-400">
                        <i class='mr-2 bx bx-map'></i> Gaindakot-01, Nawalpur
                    </li>
                    <li class="flex items-center mb-3 hover:text-blue-400">
                        <i class='mr-2 bx bx-phone'></i> 078-7501202 / 9812211443
                    </li>
                    <li class="flex items-center mb-3 hover:text-blue-400">
                        <i class='mr-2 bx bx-envelope'></i> info@Bro'scarrental.com
                    </li>
                </ul>
            </div>
            <!-- Quick Links -->
            <div>
                <h3 class="mb-2 font-bold">Quick Links</h3>
                <ul>
                    <li class="mb-2"><a href="{{ route('users.index') }}" class="hover:text-blue-400">Home</a></li>
                    <li class="mb-2"><a href="{{ route('users.about') }}" class="hover:text-blue-400">About Us</a>
                    </li>
                    <li class="mb-2"><a href="{{ route('users.services') }}" class="hover:text-blue-400">Our
                            Services</a></li>
                </ul>
            </div>
            <!-- Social Network -->
            <div>
                <h3 class="mb-2 font-bold">Follow Us On</h3>
                <div class="flex space-x-4">
                    <a href="https://www.facebook.com/sohanmessi10" class="hover:text-blue-400"><i
                            class='bx bxl-facebook'></i></a>
                    <a href="https://twitter.com/SohanKafle" class="hover:text-blue-400"><i
                            class='bx bxl-twitter'></i></a>
                    <a href="https://www.instagram.com/sohan_lm10/" class="hover:text-blue-400"><i
                            class='bx bxl-instagram'></i></a>
                    <a href="https://www.linkedin.com/in/sohan-kafle/" class="hover:text-blue-400"><i
                            class='bx bxl-linkedin'></i></a>
                </div>
            </div>
        </div>
    </footer>
    <div class="footer-line"></div>
    <div class="py-2 text-center text-white bg-gray-900 copyright">
        <p>&#169; All Rights Reserved Bro'sCARRENTAL</p>
    </div>

    {{-- <------------------------Back to Top Button----------------------------------> --}}
    <button class="back-to-top" onclick="scrollToTop()"><i class="bx bx-up-arrow-alt"></i></button>

    <script>
        window.onscroll = function() {
            let button = document.querySelector('.back-to-top');
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                button.style.display = 'block';
            } else {
                button.style.display = 'none';
            }
        };

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>

</body>

</html>
