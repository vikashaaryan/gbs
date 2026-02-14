<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

    <style>
        /* Custom styles */


        .tab-button {
            transition: all 0.2s ease;
        }

        .tab-button.active {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        /* Mobile menu animation */
        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .mobile-menu.active {
            max-height: 500px;
            transition: max-height 0.5s ease-in;
        }

        /* Prevent body scroll when mobile menu is open */
        body.menu-open {
            overflow: hidden;
        }


        /* Better touch targets for mobile */
        .touch-target {
            min-height: 44px;
            min-width: 44px;
        }

        /* Improved hamburger animation */
        .hamburger-line {
            transition: all 0.3s ease;
        }

        .hamburger.active .hamburger-line:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }

        .hamburger.active .hamburger-line:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active .hamburger-line:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Transparent Header with Glass Morphism Effect -->
    <!-- Transparent Header with Glass Morphism Effect -->
   <header class="fixed top-0 left-0 right-0 z-50 backdrop-blur-md bg-white/90 border-b border-gray-200/80 shadow-sm">
    <div class="container mx-auto px-4 sm:px-6 py-3 flex justify-between items-center">
        <!-- Logo and Brand -->
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" class="flex items-center gap-2 hover:opacity-90 transition-opacity">
                <img src="{{ asset('logo.png') }}" alt="GBS Hub Logo" class="w-28 md:w-35 h-auto">
            </a>
        </div>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex gap-6">
            <a href="{{ route('home') }}"
                class="text-gray-700 hover:text-teal-600 transition-colors font-medium flex items-center gap-1 touch-target px-3">
                <i class="fas fa-home text-sm sm:text-base"></i>
                <span class="text-sm sm:text-base">Home</span>
            </a>
            <a href="#"
                class="text-gray-700 hover:text-teal-600 transition-colors font-medium flex items-center gap-1 touch-target px-3">
                <i class="fas fa-info-circle text-sm sm:text-base"></i>
                <span class="text-sm sm:text-base">About</span>
            </a>
            <a href="#"
                class="text-gray-700 hover:text-teal-600 transition-colors font-medium flex items-center gap-1 touch-target px-3">
                <i class="fas fa-envelope text-sm sm:text-base"></i>
                <span class="text-sm sm:text-base">Contact</span>
            </a>
        </nav>

        <!-- Professional Location Search - Desktop -->
        <div class="hidden lg:block w-80">
            <div class="relative">
                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-teal-500 focus-within:border-teal-500 transition-all bg-white">
                    <div class="pl-3">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="location_search_desktop" 
                        class="w-full px-3 py-2.5 outline-none text-gray-700 placeholder-gray-400"
                        placeholder="Search city, state, or country..." 
                        autocomplete="off">
                    <button type="button" id="current_location_desktop" 
                        class="px-3 py-2.5 bg-gray-50 hover:bg-teal-50 border-l border-gray-300 transition-colors group" 
                        title="Use my current location">
                        <i class="fas fa-location-dot text-gray-500 group-hover:text-teal-600"></i>
                    </button>
                </div>
                
                <!-- Location Results Dropdown - Desktop -->
                <div id="location_results_desktop" 
                    class="absolute z-20 w-full bg-white border border-gray-300 rounded-lg mt-2 max-h-80 overflow-y-auto hidden shadow-xl">
                </div>
            </div>
            
            <!-- Selected Location Display - Desktop -->
            <div id="selected_location_desktop" class="mt-2 hidden">
                <div class="flex items-center justify-between bg-teal-50 border border-teal-200 rounded-lg p-2">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-map-pin text-teal-600 text-sm"></i>
                        <div>
                            <span class="text-sm font-medium text-teal-800" id="selected_location_name_desktop"></span>
                            <p class="text-xs text-teal-600" id="selected_location_details_desktop"></p>
                        </div>
                    </div>
                    <button type="button" onclick="clearSelectedLocation('desktop')" 
                        class="text-teal-500 hover:text-teal-700 p-1 hover:bg-teal-100 rounded-full transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Auth Buttons / User Profile (Desktop) -->
        <div class="hidden md:flex items-center gap-4">
            @auth
                <!-- User Profile Dropdown -->
                <div class="relative group" id="userDropdown">
                    <button
                        class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-50 transition-all touch-target">
                        <div
                            class="flex items-center justify-center w-9 h-9 rounded-full bg-gradient-to-r from-teal-500 to-teal-600 text-white font-semibold shadow-sm">
                            {{ strtoupper(substr(Auth::user()->full_name, 0, 1)) }}
                        </div>
                        <div class="text-left">
                            <div class="font-medium text-gray-800 text-sm">{{ Auth::user()->full_name }}</div>
                            <div class="text-xs text-gray-500 truncate max-w-[120px]">{{ Auth::user()->email }}</div>
                        </div>
                        <i
                            class="fas fa-chevron-down text-gray-400 text-xs ml-1 transition-transform group-hover:rotate-180"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div
                        class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 origin-top-right z-50">
                        <div class="p-4 border-b border-gray-100">
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-r from-teal-500 to-teal-600 text-white font-bold text-lg shadow-sm">
                                    {{ strtoupper(substr(Auth::user()->full_name, 0, 1)) }}
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">{{ Auth::user()->full_name }}</h4>
                                    <p class="text-sm text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                    <div class="flex items-center gap-1 mt-1">
                                        <span
                                            class="px-2 py-0.5 text-xs rounded-full {{ Auth::user()->verified ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ Auth::user()->verified ? 'Verified' : 'Pending' }}
                                        </span>
                                        <span class="px-2 py-0.5 text-xs rounded-full bg-blue-100 text-blue-800">
                                            {{ Auth::user()->circle->title ?? 'No Circle' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="py-2">
                            <a href=""
                                class="flex items-center gap-3 px-4 py-2.5 text-gray-700 hover:bg-gray-50 hover:text-teal-600 transition-colors">
                                <i class="fas fa-tachometer-alt w-5 text-center text-gray-400"></i>
                                <span>Dashboard</span>
                            </a>
                            <a href=""
                                class="flex items-center gap-3 px-4 py-2.5 text-gray-700 hover:bg-gray-50 hover:text-teal-600 transition-colors">
                                <i class="fas fa-user-edit w-5 text-center text-gray-400"></i>
                                <span>Edit Profile</span>
                            </a>
                            <a href="#"
                                class="flex items-center gap-3 px-4 py-2.5 text-gray-700 hover:bg-gray-50 hover:text-teal-600 transition-colors">
                                <i class="fas fa-cog w-5 text-center text-gray-400"></i>
                                <span>Settings</span>
                            </a>
                        </div>

                        <div class="border-t border-gray-100 py-2">
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-3 w-full px-4 py-2.5 text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors">
                                    <i class="fas fa-sign-out-alt w-5 text-center"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <!-- Login/Register Buttons for Guests -->
                <a href="{{ route('login') }}"
                    class="text-teal-600 font-medium hover:text-teal-700 transition-colors flex items-center touch-target px-3">
                    <i class="fas fa-sign-in-alt mr-1 text-sm sm:text-base"></i>
                    <span class="text-sm sm:text-base">Login</span>
                </a>
                <a href="{{ route('register') }}"
                    class="bg-gradient-to-r from-teal-600 to-teal-700 text-white px-4 sm:px-5 py-2 rounded-lg font-medium hover:from-teal-700 hover:to-green-800 transition-all shadow-sm flex items-center touch-target">
                    <i class="fas fa-user-plus mr-2 text-sm sm:text-base"></i>
                    <span class="text-sm sm:text-base">Register</span>
                </a>
            @endauth
        </div>

        <!-- Mobile Menu Button & Location Toggle -->
        <div class="flex items-center gap-2 md:hidden">
            <!-- Mobile Location Toggle Button -->
            <button type="button" id="mobile_location_toggle" 
                class="p-2 text-gray-600 hover:text-teal-600 hover:bg-gray-100 rounded-lg transition-colors touch-target"
                onclick="toggleMobileLocation()">
                <i class="fas fa-map-marker-alt text-lg"></i>
            </button>
            
            <!-- Hamburger Menu Button -->
            <button class="hamburger touch-target w-10 h-10 flex flex-col justify-center items-center"
                onclick="toggleMobileMenu()" aria-label="Toggle menu">
                <span class="hamburger-line block w-6 h-0.5 bg-gray-700 mb-1.5"></span>
                <span class="hamburger-line block w-6 h-0.5 bg-gray-700 mb-1.5"></span>
                <span class="hamburger-line block w-6 h-0.5 bg-gray-700"></span>
            </button>
        </div>
    </div>

    <!-- Mobile Location Search Panel (Hidden by default) -->
    <div id="mobile_location_panel" class="md:hidden bg-white border-t border-gray-200 hidden">
        <div class="container mx-auto px-4 py-3">
            <div class="relative">
                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-teal-500 focus-within:border-teal-500 transition-all bg-white">
                    <div class="pl-3">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" id="location_search_mobile" 
                        class="w-full px-3 py-3 outline-none text-gray-700 placeholder-gray-400 text-base"
                        placeholder="Search city, state, or country..." 
                        autocomplete="off">
                    <button type="button" id="current_location_mobile" 
                        class="px-4 py-3 bg-gray-50 hover:bg-teal-50 border-l border-gray-300 transition-colors group"
                        title="Use my current location">
                        <i class="fas fa-location-dot text-gray-500 group-hover:text-teal-600"></i>
                    </button>
                </div>
                
                <!-- Location Results Dropdown - Mobile -->
                <div id="location_results_mobile" 
                    class="absolute z-20 w-full bg-white border border-gray-300 rounded-lg mt-2 max-h-80 overflow-y-auto hidden shadow-xl">
                </div>
            </div>
            
            <!-- Selected Location Display - Mobile -->
            <div id="selected_location_mobile" class="mt-2 hidden">
                <div class="flex items-center justify-between bg-teal-50 border border-teal-200 rounded-lg p-3">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-map-pin text-teal-600"></i>
                        <div>
                            <span class="text-sm font-medium text-teal-800" id="selected_location_name_mobile"></span>
                            <p class="text-xs text-teal-600" id="selected_location_details_mobile"></p>
                        </div>
                    </div>
                    <button type="button" onclick="clearSelectedLocation('mobile')" 
                        class="text-teal-500 hover:text-teal-700 p-2 hover:bg-teal-100 rounded-full transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            
            <!-- Popular locations for quick select (Mobile) -->
            <div class="mt-3">
                <p class="text-xs font-medium text-gray-500 mb-2">POPULAR LOCATIONS</p>
                <div class="flex flex-wrap gap-2">
                    <button onclick="quickSelectLocation('New York')" class="px-3 py-1.5 bg-gray-100 hover:bg-teal-100 text-gray-700 hover:text-teal-700 rounded-full text-sm transition-colors">New York</button>
                    <button onclick="quickSelectLocation('London')" class="px-3 py-1.5 bg-gray-100 hover:bg-teal-100 text-gray-700 hover:text-teal-700 rounded-full text-sm transition-colors">London</button>
                    <button onclick="quickSelectLocation('Tokyo')" class="px-3 py-1.5 bg-gray-100 hover:bg-teal-100 text-gray-700 hover:text-teal-700 rounded-full text-sm transition-colors">Tokyo</button>
                    <button onclick="quickSelectLocation('Sydney')" class="px-3 py-1.5 bg-gray-100 hover:bg-teal-100 text-gray-700 hover:text-teal-700 rounded-full text-sm transition-colors">Sydney</button>
                    <button onclick="quickSelectLocation('Dubai')" class="px-3 py-1.5 bg-gray-100 hover:bg-teal-100 text-gray-700 hover:text-teal-700 rounded-full text-sm transition-colors">Dubai</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div class="mobile-menu md:hidden bg-white border-t border-gray-200 shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <!-- Mobile Menu Links -->
            <div class="space-y-2 mb-6">
                <a href="{{ route('home') }}"
                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:text-teal-600 hover:bg-gray-50 rounded-lg transition-colors touch-target">
                    <i class="fas fa-home w-5 text-center"></i>
                    <span class="font-medium">Home</span>
                </a>
                <a href="#"
                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:text-teal-600 hover:bg-gray-50 rounded-lg transition-colors touch-target">
                    <i class="fas fa-info-circle w-5 text-center"></i>
                    <span class="font-medium">About</span>
                </a>
                <a href="#"
                    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:text-teal-600 hover:bg-gray-50 rounded-lg transition-colors touch-target">
                    <i class="fas fa-envelope w-5 text-center"></i>
                    <span class="font-medium">Contact</span>
                </a>
            </div>

            <!-- Mobile Auth Buttons / User Profile -->
            @auth
                <!-- User Profile Section for Mobile -->
                <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <div class="flex items-center gap-3 mb-3">
                        <div
                            class="flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-r from-teal-500 to-teal-600 text-white font-bold text-lg shadow-sm">
                            {{ strtoupper(substr(Auth::user()->full_name, 0, 1)) }}
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">{{ Auth::user()->full_name }}</h4>
                            <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                            <div class="flex items-center gap-1 mt-1">
                                <span
                                    class="px-2 py-0.5 text-xs rounded-full {{ Auth::user()->verified ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ Auth::user()->verified ? 'Verified' : 'Pending' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <a href=""
                            class="flex items-center gap-3 px-3 py-2 text-gray-700 hover:text-teal-600 hover:bg-white rounded transition-colors">
                            <i class="fas fa-tachometer-alt w-5 text-center text-gray-400"></i>
                            <span>Dashboard</span>
                        </a>
                        <a href=""
                            class="flex items-center gap-3 px-3 py-2 text-gray-700 hover:text-teal-600 hover:bg-white rounded transition-colors">
                            <i class="fas fa-user-edit w-5 text-center text-gray-400"></i>
                            <span>Edit Profile</span>
                        </a>
                        <a href="#"
                            class="flex items-center gap-3 px-3 py-2 text-gray-700 hover:text-teal-600 hover:bg-white rounded transition-colors">
                            <i class="fas fa-cog w-5 text-center text-gray-400"></i>
                            <span>Settings</span>
                        </a>
                    </div>
                </div>

                <!-- Logout Button for Mobile -->
                <div class="pt-4 border-t border-gray-200">
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit"
                            class="flex items-center justify-center gap-2 w-full px-4 py-3 text-red-600 font-medium hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors touch-target">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            @else
                <!-- Mobile Auth Buttons for Guests -->
                <div class="space-y-3 pt-4 border-t border-gray-200">
                    <a href="{{ route('login') }}"
                        class="flex items-center justify-center gap-2 px-4 py-3 text-teal-600 font-medium hover:text-teal-700 hover:bg-teal-50 rounded-lg transition-colors touch-target">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Login to Account</span>
                    </a>
                    <a href="{{ route('register') }}"
                        class="flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-teal-600 to-teal-700 text-white font-medium hover:from-teal-700 hover:to-green-800 rounded-lg transition-all shadow-sm touch-target">
                        <i class="fas fa-user-plus"></i>
                        <span>Create New Account</span>
                    </a>
                </div>
            @endauth
        </div>
    </div>
</header>

    <!-- Main Content Area -->
    <main class="md:pt-34 pt-22 pb-20 md:pb-20">
        <!-- Content will be inserted here -->
        @section('content')
        @show
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-gray-900 to-gray-800 text-white py-8 md:py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <!-- Logo and Tagline -->
            <div class="text-center mb-8">
                <h2 class="text-2xl md:text-3xl font-bold mb-2">GBS<span class="text-teal-400">Hub</span></h2>
                <p class="text-gray-300 text-sm md:text-base">Connecting Professionals Worldwide</p>
            </div>

            <!-- Footer Links Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8 mb-8">
                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-bold mb-3 md:mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition-colors text-sm md:text-base">Home</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition-colors text-sm md:text-base">About
                                Us</a></li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition-colors text-sm md:text-base">Contact</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition-colors text-sm md:text-base">Privacy
                                Policy</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div>
                    <h4 class="text-lg font-bold mb-3 md:mb-4">Categories</h4>
                    <ul class="space-y-2">
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition-colors text-sm md:text-base">Doctors</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition-colors text-sm md:text-base">IT
                                Professionals</a></li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition-colors text-sm md:text-base">Lawyers</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition-colors text-sm md:text-base">Real
                                Estate</a></li>
                    </ul>
                </div>

                <!-- Resources -->
                <div>
                    <h4 class="text-lg font-bold mb-3 md:mb-4">Resources</h4>
                    <ul class="space-y-2">
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition-colors text-sm md:text-base">Blog</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition-colors text-sm md:text-base">Help
                                Center</a></li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition-colors text-sm md:text-base">FAQs</a>
                        </li>
                        <li><a href="#"
                                class="text-gray-300 hover:text-white transition-colors text-sm md:text-base">Tutorials</a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-lg font-bold mb-3 md:mb-4">Contact Us</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start text-gray-300">
                            <i class="fas fa-envelope mt-1 mr-3 text-teal-400 flex-shrink-0"></i>
                            <span class="text-sm md:text-base">support@gbshub.com</span>
                        </li>
                        <li class="flex items-start text-gray-300">
                            <i class="fas fa-phone mt-1 mr-3 text-teal-400 flex-shrink-0"></i>
                            <span class="text-sm md:text-base">+1 (555) 123-4567</span>
                        </li>
                        <li class="flex items-start text-gray-300">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-teal-400 flex-shrink-0"></i>
                            <span class="text-sm md:text-base">123 Business St, City</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Social Media Links -->
            <div class="flex justify-center space-x-6 mb-8">
                <a href="#"
                    class="text-gray-300 hover:text-white transition-colors touch-target w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-800">
                    <i class="fab fa-facebook-f text-lg"></i>
                </a>
                <a href="#"
                    class="text-gray-300 hover:text-white transition-colors touch-target w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-800">
                    <i class="fab fa-twitter text-lg"></i>
                </a>
                <a href="#"
                    class="text-gray-300 hover:text-white transition-colors touch-target w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-800">
                    <i class="fab fa-linkedin-in text-lg"></i>
                </a>
                <a href="#"
                    class="text-gray-300 hover:text-white transition-colors touch-target w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-800">
                    <i class="fab fa-instagram text-lg"></i>
                </a>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-700 pt-6 text-center text-gray-400">
                <p class="text-sm md:text-base">&copy; 2024 GBS Hub. All rights reserved.</p>
                <p class="text-xs md:text-sm mt-2">Designed for professionals worldwide</p>
            </div>
        </div>
    </footer>
<script>
    // Location search functionality
    let searchTimeout;

    // Initialize location search based on device
    function initLocationSearch(device) {
        const searchInput = document.getElementById(`location_search_${device}`);
        const resultsDiv = document.getElementById(`location_results_${device}`);

        if (!searchInput) return;

        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value.trim();

            if (query.length < 2) {
                resultsDiv.classList.add('hidden');
                return;
            }

            // Show loader
            resultsDiv.innerHTML = `
                <div class="px-4 py-4 text-gray-500 flex items-center justify-center">
                    <svg class="animate-spin h-5 w-5 text-teal-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Searching locations...
                </div>
            `;
            resultsDiv.classList.remove('hidden');

            searchTimeout = setTimeout(() => {
                fetch(`/search-locations?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(locations => {
                        if (locations.length > 0) {
                            resultsDiv.innerHTML = locations.map(loc => `
                                <div class="px-4 py-3 hover:bg-gray-50 cursor-pointer border-b last:border-b-0 transition ${!loc.exists ? 'text-amber-600 bg-amber-50' : ''}"
                                     onclick='selectLocation(${JSON.stringify(loc).replace(/'/g, "\\'")}, "${device}")'>
                                    <div class="flex items-start gap-3">
                                        <i class="fas fa-map-marker-alt mt-1 ${!loc.exists ? 'text-amber-500' : 'text-gray-400'}"></i>
                                        <div>
                                            <div class="font-medium ${!loc.exists ? 'text-amber-700' : 'text-gray-800'}">
                                                ${loc.name || loc.city || ''}
                                            </div>
                                            <div class="text-sm ${!loc.exists ? 'text-amber-600' : 'text-gray-500'}">
                                                ${loc.display || loc.name || ''}
                                            </div>
                                            ${!loc.exists ? '<div class="text-xs text-amber-500 mt-1">Click to search this location</div>' : ''}
                                        </div>
                                    </div>
                                </div>
                            `).join('');
                        } else {
                            resultsDiv.innerHTML = `
                                <div class="px-4 py-8 text-gray-500 text-center">
                                    <i class="fas fa-map-marker-alt text-gray-300 text-3xl mb-2"></i>
                                    <div>No locations found for "${query}"</div>
                                    <div class="text-xs mt-1">Try a different search term</div>
                                </div>
                            `;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        resultsDiv.innerHTML = `
                            <div class="px-4 py-6 text-red-500 text-center">
                                <i class="fas fa-exclamation-triangle text-red-300 text-2xl mb-2"></i>
                                <div>Failed to fetch locations</div>
                                <div class="text-xs mt-1">Please try again</div>
                            </div>
                        `;
                    });
            }, 500);
        });

        // Handle enter key
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const query = this.value.trim();
                if (query) {
                    selectLocation({
                        name: query,
                        city: query,
                        display: `Search for "${query}"`,
                        exists: false
                    }, device);
                }
            }
        });
    }

    // Initialize search for all devices
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize desktop and mobile search
        initLocationSearch('desktop');
        initLocationSearch('mobile');

        // Setup current location buttons
        setupCurrentLocation('desktop');
        setupCurrentLocation('mobile');
    });

    // Setup current location button
    function setupCurrentLocation(device) {
        const btn = document.getElementById(`current_location_${device}`);
        if (!btn) return;

        btn.addEventListener('click', function() {
            getCurrentLocation(device);
        });
    }

    // Get user's current location
    function getCurrentLocation(device) {
        if (!navigator.geolocation) {
            alert('Geolocation is not supported by your browser');
            return;
        }

        const btn = document.getElementById(`current_location_${device}`);
        const originalHtml = btn.innerHTML;

        // Show loading state
        btn.innerHTML = '<i class="fas fa-spinner fa-spin text-teal-600"></i>';
        btn.disabled = true;

        navigator.geolocation.getCurrentPosition(
            function(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                // Use reverse geocoding to get location name
                fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&accept-language=en`)
                    .then(response => response.json())
                    .then(data => {
                        const location = {
                            name: data.address?.city || data.address?.town || data.address?.village || data.address?.state || 'Unknown location',
                            city: data.address?.city || data.address?.town || data.address?.village,
                            state: data.address?.state,
                            country: data.address?.country,
                            display: data.display_name,
                            exists: true,
                            lat: lat,
                            lng: lng
                        };
                        selectLocation(location, device);
                    })
                    .catch(error => {
                        console.error('Reverse geocoding error:', error);
                        selectLocation({
                            name: `Location at ${lat.toFixed(4)}, ${lng.toFixed(4)}`,
                            display: `Latitude: ${lat.toFixed(4)}, Longitude: ${lng.toFixed(4)}`,
                            exists: false,
                            lat: lat,
                            lng: lng
                        }, device);
                    })
                    .finally(() => {
                        btn.innerHTML = originalHtml;
                        btn.disabled = false;
                    });
            },
            function(error) {
                let message = 'Unable to get your location';
                switch (error.code) {
                    case error.PERMISSION_DENIED:
                        message = 'Please allow location access';
                        break;
                    case error.POSITION_UNAVAILABLE:
                        message = 'Location information unavailable';
                        break;
                    case error.TIMEOUT:
                        message = 'Location request timed out';
                        break;
                }
                alert(message);
                btn.innerHTML = originalHtml;
                btn.disabled = false;
            }
        );
    }

    // Select location function (SINGLE DEFINITION)
    window.selectLocation = function(location, device) {
        // Close results dropdown
        const resultsDiv = document.getElementById(`location_results_${device}`);
        if (resultsDiv) {
            resultsDiv.classList.add('hidden');
        }

        // Update search input
        const searchInput = document.getElementById(`location_search_${device}`);
        if (searchInput) {
            searchInput.value = location.display || location.name || location.city || '';
        }

        // Show selected location
        const nameElement = document.getElementById(`selected_location_name_${device}`);
        const detailsElement = document.getElementById(`selected_location_details_${device}`);
        const selectedDiv = document.getElementById(`selected_location_${device}`);

        if (nameElement && detailsElement && selectedDiv) {
            // Use only non-empty values
            let displayName = location.city || location.state || location.country || location.name || 'Selected location';
            let displayDetails = location.display || '';
            
            // Build details from available non-empty data
            if (!displayDetails) {
                const parts = [];
                if (location.city && location.city !== 'null' && location.city.trim() !== '') 
                    parts.push(location.city);
                if (location.state && location.state !== 'null' && location.state.trim() !== '') 
                    parts.push(location.state);
                if (location.country && location.country !== 'null' && location.country.trim() !== '') 
                    parts.push(location.country);
                displayDetails = parts.join(', ');
            }
            
            nameElement.textContent = displayName;
            detailsElement.textContent = displayDetails;
            selectedDiv.classList.remove('hidden');

            // Add animation
            selectedDiv.classList.add('animate-pulse');
            setTimeout(() => {
                selectedDiv.classList.remove('animate-pulse');
            }, 500);
        }

        // Hide mobile panel after selection on mobile
        if (device === 'mobile') {
            toggleMobileLocation();
        }

        // Prepare location data for filtering - ONLY include non-empty values
        let locationData = {};
        
        if (location.city && location.city !== 'null' && location.city.trim() !== '') {
            locationData.city = location.city.trim();
        }
        if (location.state && location.state !== 'null' && location.state.trim() !== '') {
            locationData.state = location.state.trim();
        }
        if (location.country && location.country !== 'null' && location.country.trim() !== '') {
            locationData.country = location.country.trim();
        }
        if (location.name && location.name !== 'null' && location.name.trim() !== '') {
            locationData.name = location.name.trim();
        }
        if (location.display && location.display !== 'null' && location.display.trim() !== '') {
            locationData.display = location.display.trim();
        }
        
        // If we have no valid data, don't filter
        if (Object.keys(locationData).length === 0) {
            window.location.href = window.location.pathname;
            return;
        }

        // Redirect with location filter
        const form = document.createElement('form');
        form.method = 'GET';
        form.action = window.location.pathname;

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'location';
        input.value = JSON.stringify(locationData);

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    };

    // Clear selected location
    window.clearSelectedLocation = function(device) {
        const selectedDiv = document.getElementById(`selected_location_${device}`);
        if (selectedDiv) selectedDiv.classList.add('hidden');

        const searchInput = document.getElementById(`location_search_${device}`);
        if (searchInput) {
            searchInput.value = '';
            searchInput.focus();
        }

        // If on mobile, keep panel open
        if (device === 'mobile') {
            // Don't close panel, just clear
        }

        // Redirect to home without location filter
        window.location.href = window.location.pathname;
    };

    // Quick select location (for mobile)
    window.quickSelectLocation = function(locationName) {
        selectLocation({
            name: locationName,
            city: locationName,
            display: locationName,
            exists: true
        }, 'mobile');
    };

    // Toggle mobile location panel
    window.toggleMobileLocation = function() {
        const panel = document.getElementById('mobile_location_panel');
        if (!panel) return;

        if (panel.classList.contains('hidden')) {
            panel.classList.remove('hidden');
            // Focus on search input
            setTimeout(() => {
                document.getElementById('location_search_mobile')?.focus();
            }, 300);
        } else {
            panel.classList.add('hidden');
        }
    };

    // Mobile menu functionality
    window.toggleMobileMenu = function() {
        const menu = document.querySelector('.mobile-menu');
        const hamburger = document.querySelector('.hamburger');
        const body = document.body;

        if (!menu || !hamburger) return;

        menu.classList.toggle('active');
        hamburger.classList.toggle('active');
        body.classList.toggle('menu-open');

        // Close location panel if open
        const mobilePanel = document.getElementById('mobile_location_panel');
        if (mobilePanel && !mobilePanel.classList.contains('hidden')) {
            mobilePanel.classList.add('hidden');
        }
    };

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        // Desktop
        const desktopSearch = document.getElementById('location_search_desktop');
        const desktopResults = document.getElementById('location_results_desktop');
        if (desktopSearch && desktopResults && !desktopSearch.contains(e.target) && !desktopResults.contains(e.target)) {
            desktopResults.classList.add('hidden');
        }

        // Mobile
        const mobileSearch = document.getElementById('location_search_mobile');
        const mobileResults = document.getElementById('location_results_mobile');
        if (mobileSearch && mobileResults && !mobileSearch.contains(e.target) && !mobileResults.contains(e.target)) {
            mobileResults.classList.add('hidden');
        }

        // Close mobile menu when clicking outside
        const menu = document.querySelector('.mobile-menu');
        const hamburger = document.querySelector('.hamburger');
        if (menu?.classList.contains('active') && 
            !menu.contains(e.target) && 
            !hamburger?.contains(e.target)) {
            menu.classList.remove('active');
            hamburger?.classList.remove('active');
            document.body.classList.remove('menu-open');
        }
    });

    // Close mobile menu when clicking on a link
    document.querySelectorAll('.mobile-menu a').forEach(link => {
        link.addEventListener('click', () => {
            const menu = document.querySelector('.mobile-menu');
            const hamburger = document.querySelector('.hamburger');
            menu?.classList.remove('active');
            hamburger?.classList.remove('active');
            document.body.classList.remove('menu-open');
        });
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            const menu = document.querySelector('.mobile-menu');
            const hamburger = document.querySelector('.hamburger');
            menu?.classList.remove('active');
            hamburger?.classList.remove('active');
            document.body.classList.remove('menu-open');
        }
    });

    // Handle escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            // Close all dropdowns and panels
            document.getElementById('location_results_desktop')?.classList.add('hidden');
            document.getElementById('location_results_mobile')?.classList.add('hidden');
            document.getElementById('mobile_location_panel')?.classList.add('hidden');
            
            // Close mobile menu
            const menu = document.querySelector('.mobile-menu');
            const hamburger = document.querySelector('.hamburger');
            menu?.classList.remove('active');
            hamburger?.classList.remove('active');
            document.body.classList.remove('menu-open');
        }
    });

    // Improved touch handling for mobile
    let lastTouchEnd = 0;
    document.addEventListener('touchend', function(e) {
        const now = (new Date()).getTime();
        if (now - lastTouchEnd <= 300) {
            e.preventDefault();
        }
        lastTouchEnd = now;
    }, false);
</script>
</body>

</html>
