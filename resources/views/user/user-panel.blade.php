@extends('layout.user-layout')

@section('title')
    GBS - Global Business Services
@endsection

@section('content')
    <!-- Tabs Navigation -->
    <div class=" md:mx-10 px-4 sm:px-6 lg:px-14">
        <div class="flex overflow-x-auto scrollbar-hide">
            <button onclick="switchTab('newsfeed')"
                class="tab-button active flex-shrink-0 py-3 rounded-md px-4 sm:py-4 sm:px-6 text-sm sm:text-base md:text-lg font-medium text-gray-700 hover:bg-gray-50 whitespace-nowrap transition-colors touch-target">
                <i class="fas fa-newspaper mr-2"></i>
                <span class="hidden xs:inline">News Feed</span>
                <span class="xs:hidden">News</span>
            </button>
            <button onclick="switchTab('resources')"
                class="tab-button flex-shrink-0 py-3 px-4 rounded-md sm:py-4 sm:px-6 text-sm sm:text-base md:text-lg font-medium text-gray-700 hover:bg-gray-50 whitespace-nowrap transition-colors touch-target">
                <i class="fas fa-book mr-2"></i>
                <span class="hidden xs:inline">Resources</span>
                <span class="xs:hidden">Resources</span>
            </button>
            <button onclick="switchTab('directory')"
                class="tab-button flex-shrink-0 py-3 px-4 rounded-md sm:py-4 sm:px-6 text-sm sm:text-base md:text-lg font-medium text-gray-700 hover:bg-gray-50 whitespace-nowrap transition-colors touch-target">
                <i class="fas fa-address-book mr-2"></i>
                <span class="hidden xs:inline">Directory</span>
                <span class="xs:hidden">Directory</span>
            </button>
            <button onclick="switchTab('profile')"
                class="tab-button flex-shrink-0 py-3 px-4 rounded-md sm:py-4 sm:px-6 text-sm sm:text-base md:text-lg font-medium text-gray-700 hover:bg-gray-50 whitespace-nowrap transition-colors touch-target">
                <i class="fas fa-user mr-2"></i>
                <span class="hidden xs:inline">My Profile</span>
                <span class="xs:hidden">Profile</span>
            </button>
        </div>
    </div>

    <!-- Tab Content -->
    <div class="px-4 sm:px-6 md:mx-12 lg:px-12 py-6 mb-8">
        <!-- News Feed Tab -->
        <div id="newsfeed" class="tab-content">
            <div class="mb-6">
                <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mb-3 sm:mb-4">Category News Feed</h3>
                <p class="text-sm sm:text-base text-gray-600 mb-6">Latest updates, posts, and announcements from professionals in this category.</p>

                <!-- Post Box -->
                <div class="bg-gray-50 rounded-lg p-4 mb-6 border border-gray-200">
                    <textarea class="w-full p-3 border border-gray-300 rounded-lg mb-3 text-sm sm:text-base" rows="3"
                        placeholder="Share your thoughts, updates, or announcements..."></textarea>
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                        <div class="flex gap-2">
                            <button class="text-gray-500 hover:text-blue-600 touch-target p-2">
                                <i class="fas fa-image"></i>
                            </button>
                            <button class="text-gray-500 hover:text-blue-600 touch-target p-2">
                                <i class="fas fa-file-pdf"></i>
                            </button>
                            <button class="text-gray-500 hover:text-blue-600 touch-target p-2">
                                <i class="fas fa-link"></i>
                            </button>
                        </div>
                        <button class="bg-blue-600 text-white px-4 sm:px-5 py-2 rounded-lg font-medium hover:bg-blue-700 w-full sm:w-auto touch-target">
                            <i class="fas fa-paper-plane mr-2"></i>Post
                        </button>
                    </div>
                </div>

                <!-- Sample Posts -->
                <div class="space-y-4 sm:space-y-6">
                    <div class="bg-white border border-gray-200 rounded-xl p-4 sm:p-5 shadow-sm">
                        <div class="flex items-start sm:items-center mb-3 sm:mb-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 rounded-full flex items-center justify-center mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-user-md text-blue-600 text-lg sm:text-xl"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-gray-800 text-sm sm:text-base truncate">Dr. Sarah Johnson</h4>
                                <p class="text-xs sm:text-sm text-gray-500">Cardiologist • 2 hours ago</p>
                            </div>
                        </div>
                        <p class="text-gray-700 text-sm sm:text-base mb-3 sm:mb-4">Just attended an excellent webinar on advanced cardiac care techniques. The field is evolving so rapidly!</p>
                        <div class="flex gap-3 sm:gap-4 text-gray-500 text-sm">
                            <button class="hover:text-blue-600 flex items-center touch-target">
                                <i class="far fa-thumbs-up mr-1 text-sm"></i>
                                <span>24</span>
                            </button>
                            <button class="hover:text-blue-600 flex items-center touch-target">
                                <i class="far fa-comment mr-1 text-sm"></i>
                                <span>8</span>
                            </button>
                            <button class="hover:text-blue-600 flex items-center touch-target">
                                <i class="far fa-share-square mr-1 text-sm"></i>
                                <span class="hidden sm:inline">Share</span>
                                <span class="sm:hidden">Share</span>
                            </button>
                        </div>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-xl p-4 sm:p-5 shadow-sm">
                        <div class="flex items-start sm:items-center mb-3 sm:mb-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-green-100 rounded-full flex items-center justify-center mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-laptop-code text-green-600 text-lg sm:text-xl"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-gray-800 text-sm sm:text-base truncate">Alex Chen</h4>
                                <p class="text-xs sm:text-sm text-gray-500">Software Architect • 5 hours ago</p>
                            </div>
                        </div>
                        <p class="text-gray-700 text-sm sm:text-base mb-3 sm:mb-4">Excited to announce our new AI-powered diagnostic tool for healthcare providers. Looking for beta testers!</p>
                        <div class="flex gap-3 sm:gap-4 text-gray-500 text-sm">
                            <button class="hover:text-blue-600 flex items-center touch-target">
                                <i class="far fa-thumbs-up mr-1 text-sm"></i>
                                <span>42</span>
                            </button>
                            <button class="hover:text-blue-600 flex items-center touch-target">
                                <i class="far fa-comment mr-1 text-sm"></i>
                                <span>15</span>
                            </button>
                            <button class="hover:text-blue-600 flex items-center touch-target">
                                <i class="far fa-share-square mr-1 text-sm"></i>
                                <span class="hidden sm:inline">Share</span>
                                <span class="sm:hidden">Share</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resources Tab -->
        <div id="resources" class="tab-content hidden">
            <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4 sm:mb-6">Category Resources</h3>
            <p class="text-sm sm:text-base text-gray-600 mb-6">Educational materials, documents, and resources curated for professionals in this field.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div class="border border-gray-200 rounded-xl p-4 sm:p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-start mb-3 sm:mb-4">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-red-100 rounded-lg flex items-center justify-center mr-3 sm:mr-4 flex-shrink-0">
                            <i class="fas fa-file-pdf text-red-600 text-lg sm:text-xl"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-bold text-gray-800 text-sm sm:text-base mb-1 truncate">Industry Standards 2024</h4>
                            <p class="text-xs sm:text-sm text-gray-500">PDF • 2.4 MB</p>
                        </div>
                    </div>
                    <p class="text-sm sm:text-base text-gray-600 mb-3 sm:mb-4">Latest industry standards and compliance requirements for professionals.</p>
                    <button class="text-blue-600 font-medium hover:text-blue-700 text-sm sm:text-base touch-target">
                        <i class="fas fa-download mr-2"></i>Download
                    </button>
                </div>

                <div class="border border-gray-200 rounded-xl p-4 sm:p-5 hover:shadow-md transition-shadow">
                    <div class="flex items-start mb-3 sm:mb-4">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-3 sm:mr-4 flex-shrink-0">
                            <i class="fas fa-video text-purple-600 text-lg sm:text-xl"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-bold text-gray-800 text-sm sm:text-base mb-1 truncate">Expert Webinar Series</h4>
                            <p class="text-xs sm:text-sm text-gray-500">Video • 45 min</p>
                        </div>
                    </div>
                    <p class="text-sm sm:text-base text-gray-600 mb-3 sm:mb-4">Recorded webinar with industry leaders discussing emerging trends.</p>
                    <button class="text-blue-600 font-medium hover:text-blue-700 text-sm sm:text-base touch-target">
                        <i class="fas fa-play-circle mr-2"></i>Watch Now
                    </button>
                </div>
            </div>
        </div>

        <!-- Directory Tab -->
        <div id="directory" class="tab-content hidden">
            <div class="mb-6">
                <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mb-4">Professional Directory</h3>
                <p class="text-sm sm:text-base text-gray-600 mb-6">Browse and connect with professionals in this category.</p>

                <!-- Filters -->
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <div class="flex flex-col sm:flex-row flex-wrap gap-3 sm:gap-4">
                        <select class="px-3 sm:px-4 py-2 border border-gray-300 rounded-lg text-sm sm:text-base flex-1 min-w-0 touch-target">
                            <option>Select City</option>
                            <option>New York</option>
                            <option>Los Angeles</option>
                            <option>Chicago</option>
                            <option>Houston</option>
                        </select>
                        <select class="px-3 sm:px-4 py-2 border border-gray-300 rounded-lg text-sm sm:text-base flex-1 min-w-0 touch-target">
                            <option>Specialization</option>
                            <option>General Practice</option>
                            <option>Specialist</option>
                            <option>Consultant</option>
                        </select>
                        <button class="bg-blue-600 text-white px-4 sm:px-5 py-2 rounded-lg font-medium hover:bg-blue-700 text-sm sm:text-base touch-target whitespace-nowrap">
                            <i class="fas fa-filter mr-2"></i>Apply Filters
                        </button>
                    </div>
                </div>

                <!-- Professional List -->
                <div class="space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between bg-white border border-gray-200 rounded-xl p-4 hover:shadow-sm gap-3 sm:gap-4">
                        <div class="flex items-center flex-1 min-w-0">
                            <div class="w-12 h-12 sm:w-14 sm:h-14 bg-blue-100 rounded-full flex items-center justify-center mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-user-md text-blue-600 text-xl sm:text-2xl"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-gray-800 text-sm sm:text-base truncate">Dr. Michael Rodriguez</h4>
                                <p class="text-gray-600 text-xs sm:text-sm">Cardiologist • New York</p>
                                <p class="text-xs sm:text-sm text-gray-500">15 years experience • 4.8★ rating</p>
                            </div>
                        </div>
                        <button class="bg-blue-50 text-blue-700 px-3 sm:px-4 py-2 rounded-lg font-medium hover:bg-blue-100 text-sm sm:text-base touch-target whitespace-nowrap">
                            <i class="fas fa-eye mr-2"></i>View Profile
                        </button>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center justify-between bg-white border border-gray-200 rounded-xl p-4 hover:shadow-sm gap-3 sm:gap-4">
                        <div class="flex items-center flex-1 min-w-0">
                            <div class="w-12 h-12 sm:w-14 sm:h-14 bg-green-100 rounded-full flex items-center justify-center mr-3 sm:mr-4 flex-shrink-0">
                                <i class="fas fa-laptop-code text-green-600 text-xl sm:text-2xl"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-bold text-gray-800 text-sm sm:text-base truncate">Jennifer Lee</h4>
                                <p class="text-gray-600 text-xs sm:text-sm">Software Developer • San Francisco</p>
                                <p class="text-xs sm:text-sm text-gray-500">Full Stack • 8 years experience</p>
                            </div>
                        </div>
                        <button class="bg-blue-50 text-blue-700 px-3 sm:px-4 py-2 rounded-lg font-medium hover:bg-blue-100 text-sm sm:text-base touch-target whitespace-nowrap">
                            <i class="fas fa-eye mr-2"></i>View Profile
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Tab -->
        <div id="profile" class="tab-content hidden">
            <div class="text-center py-8 sm:py-10">
                <div class="w-20 h-20 sm:w-24 sm:h-24 mx-auto mb-4 sm:mb-6 bg-teal-600 rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-white text-3xl sm:text-4xl"></i>
                </div>
                <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mb-3 sm:mb-4">Your Profile</h3>
                <p class="text-sm sm:text-base text-gray-600 mb-6 sm:mb-8 max-w-md mx-auto px-4">
                    To view and manage your profile, please login or create an account.
                </p>
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center px-4">
                    <a href="{{ route('login') }}"
                        class="bg-teal-600 text-white px-5 sm:px-6 py-3 rounded-lg font-medium hover:bg-teal-700 text-sm sm:text-base touch-target text-center">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-teal-600 hover:bg-teal-700 text-white px-5 sm:px-6 py-3 rounded-lg font-medium hover:from-blue-700 hover:to-blue-800 text-sm sm:text-base touch-target text-center">
                        <i class="fas fa-user-plus mr-2"></i>Register Now
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab switching functionality
        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
            });

            // Remove active state from all tab buttons
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('active', 'border-b-2', 'border-teal-600', 'text-teal-600', 'bg-teal-50');
                button.classList.add('text-gray-700');
            });

            // Show selected tab content
            const activeTab = document.getElementById(tabName);
            if (activeTab) {
                activeTab.classList.remove('hidden');
            }

            // Add active state to clicked button
            const activeButton = Array.from(document.querySelectorAll('.tab-button')).find(button => 
                button.getAttribute('onclick').includes(tabName)
            );
            if (activeButton) {
                activeButton.classList.add('active', 'border-b-2', 'border-teal-600', 'text-teal-600', 'bg-blue-50');
                activeButton.classList.remove('text-gray-700');
            }

            // Update URL hash for bookmarking (optional)
            history.pushState(null, null, `#${tabName}`);
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Check URL hash for initial tab
            const hash = window.location.hash.substring(1);
            const validTabs = ['newsfeed', 'resources', 'directory', 'profile'];
            
            if (validTabs.includes(hash)) {
                switchTab(hash);
            } else {
                // Default to newsfeed
                switchTab('newsfeed');
            }

            // Add scroll behavior to tabs on mobile
            const tabsContainer = document.querySelector('.flex.overflow-x-auto');
            if (tabsContainer) {
                // Ensure active tab is visible on mobile
                const activeTab = tabsContainer.querySelector('.tab-button.active');
                if (activeTab) {
                    activeTab.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
                }
            }

            // Add touch swipe for mobile tab switching
            let touchStartX = 0;
            let touchEndX = 0;
            
            const tabContents = document.getElementById('tabContents');
            if (tabContents) {
                tabContents.addEventListener('touchstart', e => {
                    touchStartX = e.changedTouches[0].screenX;
                });

                tabContents.addEventListener('touchend', e => {
                    touchEndX = e.changedTouches[0].screenX;
                    handleSwipe();
                });
            }

            function handleSwipe() {
                const swipeThreshold = 50;
                const currentTab = document.querySelector('.tab-button.active').getAttribute('onclick');
                const tabs = ['newsfeed', 'resources', 'directory', 'profile'];
                const currentIndex = tabs.findIndex(tab => currentTab.includes(tab));
                
                if (touchStartX - touchEndX > swipeThreshold) {
                    const nextIndex = (currentIndex + 1) % tabs.length;
                    switchTab(tabs[nextIndex]);
                } else if (touchEndX - touchStartX > swipeThreshold) {
                    const prevIndex = (currentIndex - 1 + tabs.length) % tabs.length;
                    switchTab(tabs[prevIndex]);
                }
            }
        });

        window.addEventListener('resize', function() {
            const tabs = document.querySelectorAll('.tab-button span');
            tabs.forEach(tab => {
                if (window.innerWidth < 480) { 
                    if (tab.classList.contains('xs:hidden')) {
                        tab.style.display = 'none';
                    } else {
                        tab.style.display = 'inline';
                    }
                } else {
                    tab.style.display = '';
                }
            });
        });
    </script>

   
@endsection