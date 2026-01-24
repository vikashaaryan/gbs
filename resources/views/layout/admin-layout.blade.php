<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @stack('styles')
</head>

<body class="bg-gray-50 overflow-hidden">
    <!-- Admin Layout Container -->
    <div class="flex h-screen">
        <!-- Sidebar - Fixed and non-scrollable -->
        <aside class="hidden md:flex flex-col w-64 bg-gradient-to-b from-gray-900 to-gray-800 text-white shadow-xl flex-shrink-0">
            <!-- Logo Section -->
            <div class="p-6 border-b border-gray-700 flex-shrink-0">
                <a href="#" class="flex items-center gap-3 hover:opacity-90 transition-opacity">
                    <div class="w-10 h-10 bg-gradient-to-r from-teal-500 to-green-500 rounded-lg flex items-center justify-center">
                        <i class="fas fa-cog text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">GBS Hub</h1>
                        <p class="text-xs text-gray-300">Admin Panel</p>
                    </div>
                </a>
            </div>

          
            <!-- Main Navigation - Scrollable within sidebar -->
            <nav class="flex-1 overflow-y-auto py-4">
                <div class="px-4 space-y-1">
                    <!-- Dashboard -->
                    <a href="#"
                        class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors">
                        <i class="fas fa-tachometer-alt w-5 text-center"></i>
                        <span>Dashboard</span>
                    </a>

                    <!-- User Management -->
                    <div class="mt-6">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">User Management</p>
                        <div class="mt-2 space-y-1">
                            <a href="#"
                                class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors">
                                <i class="fas fa-users w-5 text-center"></i>
                                <span>All Users</span>
                            </a>
                            <a href="#"
                                class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors">
                                <i class="fas fa-user-plus w-5 text-center"></i>
                                <span>Add New User</span>
                            </a>
                        </div>
                    </div>

                    <!-- Content Management -->
                    <div class="mt-6">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Content</p>
                        <div class="mt-2 space-y-1">
                            <a href="#"
                                class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors">
                                <i class="fas fa-newspaper w-5 text-center"></i>
                                <span>Posts</span>
                            </a>
                            <a href="{{ route('admin.circles.index') }}"
                                class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors">
                                <i class="fas fa-tags w-5 text-center"></i>
                                <span>Categories</span>
                            </a>
                        </div>
                    </div>

                    <!-- Settings -->
                    <div class="mt-6">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Settings</p>
                        <div class="mt-2 space-y-1">
                            <a href="#"
                                class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors">
                                <i class="fas fa-cog w-5 text-center"></i>
                                <span>System Settings</span>
                            </a>
                            <a href="#"
                                class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors">
                                <i class="fas fa-chart-bar w-5 text-center"></i>
                                <span>Analytics</span>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Logout Button - Fixed at bottom -->
            <div class="p-6 border-t border-gray-700 flex-shrink-0">
                <button type="submit"
                    class="flex items-center gap-3 w-full px-4 py-3 text-gray-300 hover:bg-red-600 hover:text-white rounded-lg transition-colors">
                    <i class="fas fa-sign-out-alt w-5 text-center"></i>
                    <span>Logout</span>
                </button>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header - Fixed -->
            <header class="bg-white shadow-sm border-b border-gray-200 flex-shrink-0 z-10">
                <div class="flex items-center justify-between px-6 py-4">
                    <!-- Left: Menu toggle and breadcrumb -->
                    <div class="flex items-center gap-4">
                        <button onclick="toggleSidebar()" class="md:hidden text-gray-600 hover:text-gray-900">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>

                    <!-- Right: Notifications, Search and Profile -->
                    <div class="flex items-center gap-4">
                        <!-- Search -->
                        <div class="hidden md:block relative">
                            <input type="text" placeholder="Search..."
                                class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent w-64">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>

                        <!-- Notifications -->
                        <button onclick="toggleNotifications()" class="relative p-2 text-gray-600 hover:text-gray-900">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute top-1 right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                        </button>

                        <!-- Profile Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <!-- Desktop Profile Button -->
                            <button @click="open = !open" class="hidden md:flex items-center gap-3 p-2 rounded-lg hover:bg-gray-100 transition-colors">
                                <div class="w-9 h-9 bg-gradient-to-r from-teal-400 to-green-400 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                    A
                                </div>
                                <div class="text-left hidden lg:block">
                                    <p class="text-sm font-medium text-gray-700 truncate">Admin User</p>
                                    <p class="text-xs text-gray-500 truncate">Super Admin</p>
                                </div>
                                <i class="fas fa-chevron-down text-gray-400 text-xs ml-1"></i>
                            </button>

                            <!-- Mobile Profile Button -->
                            <button @click="open = !open" class="md:hidden p-2 text-gray-600 hover:text-gray-900">
                                <div class="w-9 h-9 bg-gradient-to-r from-teal-400 to-green-400 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                    A
                                </div>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" @click.away="open = false" 
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-lg border border-gray-200 py-2 z-50">
                                
                                <!-- Profile Info -->
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 bg-gradient-to-r from-teal-400 to-green-400 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                            A
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-gray-800">Admin User</h4>
                                            <p class="text-sm text-gray-500 truncate">admin@gbshub.com</p>
                                            <p class="text-xs text-teal-600 bg-teal-50 px-2 py-1 rounded-full mt-1 inline-block">Super Admin</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Menu Items -->
                                <div class="py-2">
                                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors">
                                        <i class="fas fa-user w-5 text-gray-500"></i>
                                        <span>My Profile</span>
                                    </a>
                                
                                </div>

                                <!-- Logout -->
                                <div class="border-t border-gray-100 pt-2">
                                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 transition-colors">
                                        <i class="fas fa-sign-out-alt w-5"></i>
                                        <span>Logout</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notifications Dropdown -->
                <div id="notificationsDropdown" class="hidden absolute right-4 top-16 w-80 bg-white rounded-xl shadow-lg border border-gray-200 py-2 z-50">
                    <div class="px-4 py-3 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <h4 class="font-semibold text-gray-800">Notifications</h4>
                            <button onclick="markAllAsRead()" class="text-xs text-teal-600 hover:text-teal-700">Mark all as read</button>
                        </div>
                    </div>
                    <div class="max-h-96 overflow-y-auto">
                        <!-- Notification Items -->
                        <div class="px-4 py-3 hover:bg-gray-50 border-b border-gray-100">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user-plus text-blue-600 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-800">New user registered</p>
                                    <p class="text-xs text-gray-500">John Doe joined the platform</p>
                                    <p class="text-xs text-gray-400 mt-1">2 minutes ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 hover:bg-gray-50 border-b border-gray-100">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-shopping-cart text-green-600 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-800">New order received</p>
                                    <p class="text-xs text-gray-500">Order #ORD-4567 placed</p>
                                    <p class="text-xs text-gray-400 mt-1">15 minutes ago</p>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 hover:bg-gray-50">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-exclamation-triangle text-purple-600 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-800">System alert</p>
                                    <p class="text-xs text-gray-500">Server load at 85%</p>
                                    <p class="text-xs text-gray-400 mt-1">1 hour ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 border-t border-gray-100">
                        <a href="#" class="block text-center text-sm text-teal-600 hover:text-teal-700 font-medium">
                            View all notifications
                        </a>
                    </div>
                </div>
            </header>

            <!-- Mobile Sidebar Overlay -->
            <div id="mobileSidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden hidden"
                onclick="toggleSidebar()"></div>

            <!-- Mobile Sidebar -->
            <aside id="mobileSidebar"
                class="fixed left-0 top-0 h-full w-64 bg-gray-900 text-white z-50 transform -translate-x-full md:hidden transition-transform duration-300 flex flex-col">
                <!-- Mobile sidebar content -->
                <div class="p-4 border-b border-gray-700 flex justify-between items-center flex-shrink-0">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-gradient-to-r from-teal-500 to-green-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-cog text-white"></i>
                        </div>
                        <div>
                            <h1 class="text-lg font-bold">GBS </h1>
                            <p class="text-xs text-gray-300">Admin</p>
                        </div>
                    </div>
                    <button onclick="toggleSidebar()" class="text-gray-300 hover:text-white">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
             
                
                <!-- Mobile Navigation -->
                <nav class="flex-1 overflow-y-auto py-4">
                    <div class="px-4 space-y-1">
                        <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors" onclick="toggleSidebar()">
                            <i class="fas fa-tachometer-alt w-5"></i>
                            <span>Dashboard</span>
                        </a>
                        <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors" onclick="toggleSidebar()">
                            <i class="fas fa-users w-5"></i>
                            <span>All Users</span>
                        </a>
                          <a href="#"
                                class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors">
                                <i class="fas fa-newspaper w-5 text-center"></i>
                                <span>Posts</span>
                            </a>
                            <a href="{{ route('admin.circles.index') }}"
                                class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors">
                                <i class="fas fa-tags w-5 text-center"></i>
                                <span>Categories</span>
                            </a>
                        <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors" onclick="toggleSidebar()">
                            <i class="fas fa-newspaper w-5"></i>
                            <span>Posts</span>
                        </a>
                        <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded-lg transition-colors" onclick="toggleSidebar()">
                            <i class="fas fa-cog w-5"></i>
                            <span>Settings</span>
                        </a>
                    </div>
                </nav>
                
                <!-- Mobile Logout -->
                <div class="p-4 border-t border-gray-700 flex-shrink-0">
                    <a href="#" class="flex items-center gap-3 w-full px-4 py-3 text-gray-300 hover:bg-red-600 hover:text-white rounded-lg transition-colors" onclick="toggleSidebar()">
                        <i class="fas fa-sign-out-alt w-5 text-center"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </aside>

            <!-- Main Content Area - Scrollable -->
            <main class="flex-1 overflow-y-auto bg-gray-50">
                <div class="p-4 md:p-6">
                    @section('content')
        @show
                </div>
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Toggle mobile sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('mobileSidebar');
            const overlay = document.getElementById('mobileSidebarOverlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');
        }

        // Toggle notifications dropdown
        function toggleNotifications() {
            const dropdown = document.getElementById('notificationsDropdown');
            dropdown.classList.toggle('hidden');
        }

        // Mark all notifications as read
        function markAllAsRead() {
            const badge = document.querySelector('[onclick="toggleNotifications()"] span');
            badge.classList.add('hidden');
            const markAllBtn = document.querySelector('[onclick="markAllAsRead()"]');
            markAllBtn.textContent = 'All read';
            markAllBtn.classList.remove('text-teal-600', 'hover:text-teal-700');
            markAllBtn.classList.add('text-gray-400');
        }

        // Close notifications when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('notificationsDropdown');
            const notifBtn = document.querySelector('[onclick="toggleNotifications()"]');
            
            if (!dropdown.contains(event.target) && !notifBtn.contains(event.target) && !dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
            }
        });

        // Auto-hide sidebar on mobile when clicking a link
        document.querySelectorAll('#mobileSidebar a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    toggleSidebar();
                }
            });
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('mobileSidebar');
            const overlay = document.getElementById('mobileSidebarOverlay');
            const toggleBtn = document.querySelector('[onclick="toggleSidebar()"]');

            if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target) && !sidebar.classList.contains('-translate-x-full')) {
                toggleSidebar();
            }
        });
    </script>

    @stack('scripts')
</body>

</html>