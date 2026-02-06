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

        <!-- Auth Buttons / User Profile (Desktop) -->
        <div class="hidden md:flex items-center gap-4">
            @auth
            <!-- User Profile Dropdown -->
            <div class="relative group" id="userDropdown">
                <button class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-gray-50 transition-all touch-target">
                    <div class="flex items-center justify-center w-9 h-9 rounded-full bg-gradient-to-r from-teal-500 to-teal-600 text-white font-semibold shadow-sm">
                        {{ strtoupper(substr(Auth::user()->full_name, 0, 1)) }}
                    </div>
                    <div class="text-left">
                        <div class="font-medium text-gray-800 text-sm">{{ Auth::user()->full_name }}</div>
                        <div class="text-xs text-gray-500 truncate max-w-[120px]">{{ Auth::user()->email }}</div>
                    </div>
                    <i class="fas fa-chevron-down text-gray-400 text-xs ml-1 transition-transform group-hover:rotate-180"></i>
                </button>

                <!-- Dropdown Menu -->
                <div class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 origin-top-right z-50">
                    <div class="p-4 border-b border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-r from-teal-500 to-teal-600 text-white font-bold text-lg shadow-sm">
                                {{ strtoupper(substr(Auth::user()->full_name, 0, 1)) }}
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">{{ Auth::user()->full_name }}</h4>
                                <p class="text-sm text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                <div class="flex items-center gap-1 mt-1">
                                    <span class="px-2 py-0.5 text-xs rounded-full {{ Auth::user()->verified ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
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
                        <a href="" class="flex items-center gap-3 px-4 py-2.5 text-gray-700 hover:bg-gray-50 hover:text-teal-600 transition-colors">
                            <i class="fas fa-tachometer-alt w-5 text-center text-gray-400"></i>
                            <span>Dashboard</span>
                        </a>
                        <a href="" class="flex items-center gap-3 px-4 py-2.5 text-gray-700 hover:bg-gray-50 hover:text-teal-600 transition-colors">
                            <i class="fas fa-user-edit w-5 text-center text-gray-400"></i>
                            <span>Edit Profile</span>
                        </a>
                        <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-gray-700 hover:bg-gray-50 hover:text-teal-600 transition-colors">
                            <i class="fas fa-cog w-5 text-center text-gray-400"></i>
                            <span>Settings</span>
                        </a>
                    </div>
                    
                    <div class="border-t border-gray-100 py-2">
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="flex items-center gap-3 w-full px-4 py-2.5 text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors">
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

        <!-- Mobile Menu Button -->
        <button class="md:hidden hamburger touch-target w-10 h-10 flex flex-col justify-center items-center"
            onclick="toggleMobileMenu()" aria-label="Toggle menu">
            <span class="hamburger-line block w-6 h-0.5 bg-gray-700 mb-1.5"></span>
            <span class="hamburger-line block w-6 h-0.5 bg-gray-700 mb-1.5"></span>
            <span class="hamburger-line block w-6 h-0.5 bg-gray-700"></span>
        </button>
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
                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-gradient-to-r from-teal-500 to-teal-600 text-white font-bold text-lg shadow-sm">
                        {{ strtoupper(substr(Auth::user()->full_name, 0, 1)) }}
                    </div>
                    <div>
                        <h4 class="font-semibold text-gray-800">{{ Auth::user()->full_name }}</h4>
                        <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                        <div class="flex items-center gap-1 mt-1">
                            <span class="px-2 py-0.5 text-xs rounded-full {{ Auth::user()->verified ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
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
        // Mobile menu functionality
        function toggleMobileMenu() {
            const menu = document.querySelector('.mobile-menu');
            const hamburger = document.querySelector('.hamburger');
            const body = document.body;

            menu.classList.toggle('active');
            hamburger.classList.toggle('active');
            body.classList.toggle('menu-open');
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const menu = document.querySelector('.mobile-menu');
            const hamburger = document.querySelector('.hamburger');

            if (menu.classList.contains('active') &&
                !menu.contains(event.target) &&
                !hamburger.contains(event.target)) {
                menu.classList.remove('active');
                hamburger.classList.remove('active');
                document.body.classList.remove('menu-open');
            }
        });

        // Close mobile menu when clicking on a link
        document.querySelectorAll('.mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                document.querySelector('.mobile-menu').classList.remove('active');
                document.querySelector('.hamburger').classList.remove('active');
                document.body.classList.remove('menu-open');
            });
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                // Close mobile menu on desktop
                document.querySelector('.mobile-menu').classList.remove('active');
                document.querySelector('.hamburger').classList.remove('active');
                document.body.classList.remove('menu-open');
            }
        });

        // Handle escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                document.querySelector('.mobile-menu').classList.remove('active');
                document.querySelector('.hamburger').classList.remove('active');
                document.body.classList.remove('menu-open');
            }
        });

        // Add loading state for better UX
        document.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function(e) {
                if (this.getAttribute('href') && !this.getAttribute('href').startsWith('#')) {
                    // Add loading indicator if needed
                    // This is a placeholder for actual page transitions
                }
            });
        });

        // Improved touch handling for mobile
        let lastTouchEnd = 0;
        document.addEventListener('touchend', function(event) {
            const now = (new Date()).getTime();
            if (now - lastTouchEnd <= 300) {
                event.preventDefault();
            }
            lastTouchEnd = now;
        }, false);
    </script>
</body>

</html>
