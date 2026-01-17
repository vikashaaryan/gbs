<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GBS - Global Business Services</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .category-card {
            transition: all 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

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
    </style>
</head>

<body class="bg-gray-50">
    <!-- Transparent Header with Glass Morphism Effect -->
    <header class="fixed top-0 left-0 right-0 z-50 backdrop-blur-md bg-white/90 border-b border-gray-200/80 shadow-sm">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="bg-gradient-to-br from-blue-600 to-blue-700 p-2 rounded-lg shadow-sm">
                    <i class="fas fa-globe text-white text-lg"></i>
                </div>
                <a href="#" class="text-2xl font-bold text-gray-800 hover:text-blue-600 transition-colors">
                    GBS<span class="text-blue-600"></span>
                </a>
            </div>
            <nav class="hidden md:flex gap-6">
                <a href="#"
                    class="text-gray-700 hover:text-blue-600 transition-colors font-medium flex items-center gap-1">
                    <i class="fas fa-home"></i>
                    Home
                </a>
                <a href="#"
                    class="text-gray-700 hover:text-blue-600 transition-colors font-medium flex items-center gap-1">
                    <i class="fas fa-info-circle"></i>
                    About
                </a>
                <a href="#"
                    class="text-gray-700 hover:text-blue-600 transition-colors font-medium flex items-center gap-1">
                    <i class="fas fa-envelope"></i>
                    Contact
                </a>
            </nav>
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}"
                    class="text-blue-600 font-medium hover:text-blue-700 transition-colors">
                    <i class="fas fa-sign-in-alt mr-1"></i> Login
            </a>
                <a href="{{ route('register') }}"
                    class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-5 py-2 rounded-lg font-medium hover:from-blue-700 hover:to-blue-800 transition-all shadow-sm">
                    <i class="fas fa-user-plus mr-2"></i>Register
        </a>
                <button class="md:hidden text-gray-700">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </header>

    @section('content')

    @show

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-gray-900 to-gray-800 text-white py-10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold mb-2">GBS<span class="text-blue-400">Hub</span></h2>
                <p class="text-gray-300">Connecting Professionals Worldwide</p>
            </div>

            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h4 class="text-lg font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white">Home</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">About Us</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Contact</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Privacy Policy</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-bold mb-4">Categories</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white">Doctors</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">IT Professionals</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Lawyers</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Real Estate</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-bold mb-4">Resources</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white">Blog</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Help Center</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">FAQs</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Tutorials</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-bold mb-4">Contact Us</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-300">
                            <i class="fas fa-envelope mr-3 text-blue-400"></i>
                            support@gbshub.com
                        </li>
                        <li class="flex items-center text-gray-300">
                            <i class="fas fa-phone mr-3 text-blue-400"></i>
                            +1 (555) 123-4567
                        </li>
                        <li class="flex items-center text-gray-300">
                            <i class="fas fa-map-marker-alt mr-3 text-blue-400"></i>
                            123 Business St, City
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 pt-6 text-center text-gray-400">
                <p>&copy; 2024 GBS Hub. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>