@extends('layout.user-layout')

@section('title')
GBS - Global Business Services
@endsection

@section('content')
<div id="particles" class="fixed inset-0 pointer-events-none z-0"></div>



    <!-- Main Content -->
    <main class="pt-20 pb-10 px-4">
        <!-- Hero Section -->
        <section class="max-w-7xl mx-auto mb-16">
            <div class="text-center py-12">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                    Welcome to <span class="text-blue-600">GBS </span>
                </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Connect with professionals across various industries. Find experts, resources, and build your network.
                </p>
            </div>
        </section>

        <!-- Categories Grid -->
        <section class="max-w-7xl mx-auto mb-16">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Browse Categories</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Category Cards -->
                <div class="category-card bg-white rounded-xl shadow-md p-6 text-center cursor-pointer">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-user-md text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Doctors & Medical</h3>
                    <p class="text-gray-600 mb-4">Medical professionals, specialists, healthcare providers</p>
                  
                </div>

                <div class="category-card bg-white rounded-xl shadow-md p-6 text-center cursor-pointer" >
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-green-100 flex items-center justify-center">
                        <i class="fas fa-laptop-code text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">IT Professionals</h3>
                    <p class="text-gray-600 mb-4">Developers, designers, tech consultants, IT services</p>
                    
                </div>

                <div class="category-card bg-white rounded-xl shadow-md p-6 text-center cursor-pointer" >
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-purple-100 flex items-center justify-center">
                        <i class="fas fa-gavel text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Lawyers & Legal</h3>
                    <p class="text-gray-600 mb-4">Legal advisors, attorneys, law firms, consultants</p>
                   
                </div>

                <div class="category-card bg-white rounded-xl shadow-md p-6 text-center cursor-pointer">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-orange-100 flex items-center justify-center">
                        <i class="fas fa-building text-orange-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Real Estate</h3>
                    <p class="text-gray-600 mb-4">Agents, brokers, property consultants, developers</p>
                    
                </div>

                <div class="category-card bg-white rounded-xl shadow-md p-6 text-center cursor-pointer">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-red-100 flex items-center justify-center">
                        <i class="fas fa-calculator text-red-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Accountants</h3>
                    <p class="text-gray-600 mb-4">CA, tax consultants, auditors, financial advisors</p>
                    
                </div>

                <div class="category-card bg-white rounded-xl shadow-md p-6 text-center cursor-pointer">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-teal-100 flex items-center justify-center">
                        <i class="fas fa-chart-line text-teal-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Business Consultants</h3>
                    <p class="text-gray-600 mb-4">Management, marketing, HR, strategy consultants</p>
                   
                </div>

                <div class="category-card bg-white rounded-xl shadow-md p-6 text-center cursor-pointer" >
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-indigo-100 flex items-center justify-center">
                        <i class="fas fa-cogs text-indigo-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Engineers</h3>
                    <p class="text-gray-600 mb-4">Civil, mechanical, electrical, software engineers</p>
                   
                </div>

                <div class="category-card bg-white rounded-xl shadow-md p-6 text-center cursor-pointer" >
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-pink-100 flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-pink-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Education</h3>
                    <p class="text-gray-600 mb-4">Teachers, tutors, trainers, educational institutes</p>
                    
                </div>
            </div>
        </section>

        {{-- <!-- Category Tabs Section (Hidden by default) -->
        <section id="categoryTabs" class="max-w-7xl mx-auto mb-16 hidden">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- Tab Header -->
                <div class="border-b border-gray-200">
                    <div class="flex overflow-x-auto">
                        <button onclick="switchTab('newsfeed')" class="tab-button active flex-1 py-4 px-6 text-lg font-medium text-gray-700 hover:bg-gray-50">
                            <i class="fas fa-newspaper mr-2"></i>News Feed
                        </button>
                        <button onclick="switchTab('resources')" class="tab-button flex-1 py-4 px-6 text-lg font-medium text-gray-700 hover:bg-gray-50">
                            <i class="fas fa-book mr-2"></i>Resources
                        </button>
                        <button onclick="switchTab('directory')" class="tab-button flex-1 py-4 px-6 text-lg font-medium text-gray-700 hover:bg-gray-50">
                            <i class="fas fa-address-book mr-2"></i>Directory
                        </button>
                        <button onclick="switchTab('profile')" class="tab-button flex-1 py-4 px-6 text-lg font-medium text-gray-700 hover:bg-gray-50">
                            <i class="fas fa-user mr-2"></i>My Profile
                        </button>
                    </div>
                </div>

                <!-- Tab Content -->
                <div class="p-6">
                    <!-- News Feed Tab -->
                    <div id="newsfeedTab" class="tab-content">
                        <div class="mb-6">
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">Category News Feed</h3>
                            <p class="text-gray-600 mb-6">Latest updates, posts, and announcements from professionals in this category.</p>
                            
                            <!-- Post Box -->
                            <div class="bg-gray-50 rounded-lg p-4 mb-6 border border-gray-200">
                                <textarea class="w-full p-3 border border-gray-300 rounded-lg mb-3" rows="3" placeholder="Share your thoughts, updates, or announcements..."></textarea>
                                <div class="flex justify-between items-center">
                                    <div class="flex gap-2">
                                        <button class="text-gray-500 hover:text-blue-600"><i class="fas fa-image"></i></button>
                                        <button class="text-gray-500 hover:text-blue-600"><i class="fas fa-file-pdf"></i></button>
                                        <button class="text-gray-500 hover:text-blue-600"><i class="fas fa-link"></i></button>
                                    </div>
                                    <button class="bg-blue-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-blue-700">
                                        <i class="fas fa-paper-plane mr-2"></i>Post
                                    </button>
                                </div>
                            </div>

                            <!-- Sample Posts -->
                            <div class="space-y-6">
                                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                                    <div class="flex items-center mb-4">
                                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                                            <i class="fas fa-user-md text-blue-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800">Dr. Sarah Johnson</h4>
                                            <p class="text-sm text-gray-500">Cardiologist • 2 hours ago</p>
                                        </div>
                                    </div>
                                    <p class="text-gray-700 mb-4">Just attended an excellent webinar on advanced cardiac care techniques. The field is evolving so rapidly!</p>
                                    <div class="flex gap-4 text-gray-500">
                                        <button class="hover:text-blue-600"><i class="far fa-thumbs-up mr-1"></i> 24</button>
                                        <button class="hover:text-blue-600"><i class="far fa-comment mr-1"></i> 8</button>
                                        <button class="hover:text-blue-600"><i class="far fa-share-square mr-1"></i> Share</button>
                                    </div>
                                </div>

                                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                                    <div class="flex items-center mb-4">
                                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                            <i class="fas fa-laptop-code text-green-600 text-xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800">Alex Chen</h4>
                                            <p class="text-sm text-gray-500">Software Architect • 5 hours ago</p>
                                        </div>
                                    </div>
                                    <p class="text-gray-700 mb-4">Excited to announce our new AI-powered diagnostic tool for healthcare providers. Looking for beta testers!</p>
                                    <div class="flex gap-4 text-gray-500">
                                        <button class="hover:text-blue-600"><i class="far fa-thumbs-up mr-1"></i> 42</button>
                                        <button class="hover:text-blue-600"><i class="far fa-comment mr-1"></i> 15</button>
                                        <button class="hover:text-blue-600"><i class="far fa-share-square mr-1"></i> Share</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Resources Tab -->
                    <div id="resourcesTab" class="tab-content hidden">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">Category Resources</h3>
                        <p class="text-gray-600 mb-6">Educational materials, documents, and resources curated for professionals in this field.</p>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="border border-gray-200 rounded-xl p-5 hover:shadow-md transition-shadow">
                                <div class="flex items-start mb-4">
                                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-file-pdf text-red-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-800 mb-1">Industry Standards 2024</h4>
                                        <p class="text-sm text-gray-500">PDF • 2.4 MB</p>
                                    </div>
                                </div>
                                <p class="text-gray-600 mb-4">Latest industry standards and compliance requirements for professionals.</p>
                                <button class="text-blue-600 font-medium hover:text-blue-700">
                                    <i class="fas fa-download mr-2"></i>Download
                                </button>
                            </div>

                            <div class="border border-gray-200 rounded-xl p-5 hover:shadow-md transition-shadow">
                                <div class="flex items-start mb-4">
                                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-video text-purple-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-800 mb-1">Expert Webinar Series</h4>
                                        <p class="text-sm text-gray-500">Video • 45 min</p>
                                    </div>
                                </div>
                                <p class="text-gray-600 mb-4">Recorded webinar with industry leaders discussing emerging trends.</p>
                                <button class="text-blue-600 font-medium hover:text-blue-700">
                                    <i class="fas fa-play-circle mr-2"></i>Watch Now
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Directory Tab -->
                    <div id="directoryTab" class="tab-content hidden">
                        <div class="mb-6">
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">Professional Directory</h3>
                            <p class="text-gray-600 mb-6">Browse and connect with professionals in this category.</p>
                            
                            <!-- Filters -->
                            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                                <div class="flex flex-wrap gap-4">
                                    <select class="px-4 py-2 border border-gray-300 rounded-lg">
                                        <option>Select City</option>
                                        <option>New York</option>
                                        <option>Los Angeles</option>
                                        <option>Chicago</option>
                                        <option>Houston</option>
                                    </select>
                                    <select class="px-4 py-2 border border-gray-300 rounded-lg">
                                        <option>Specialization</option>
                                        <option>General Practice</option>
                                        <option>Specialist</option>
                                        <option>Consultant</option>
                                    </select>
                                    <button class="bg-blue-600 text-white px-5 py-2 rounded-lg font-medium hover:bg-blue-700">
                                        <i class="fas fa-filter mr-2"></i>Apply Filters
                                    </button>
                                </div>
                            </div>

                            <!-- Professional List -->
                            <div class="space-y-4">
                                <div class="flex items-center justify-between bg-white border border-gray-200 rounded-xl p-4 hover:shadow-sm">
                                    <div class="flex items-center">
                                        <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                                            <i class="fas fa-user-md text-blue-600 text-2xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800">Dr. Michael Rodriguez</h4>
                                            <p class="text-gray-600">Cardiologist • New York</p>
                                            <p class="text-sm text-gray-500">15 years experience • 4.8★ rating</p>
                                        </div>
                                    </div>
                                    <button class="bg-blue-50 text-blue-700 px-4 py-2 rounded-lg font-medium hover:bg-blue-100">
                                        <i class="fas fa-eye mr-2"></i>View Profile
                                    </button>
                                </div>

                                <div class="flex items-center justify-between bg-white border border-gray-200 rounded-xl p-4 hover:shadow-sm">
                                    <div class="flex items-center">
                                        <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                            <i class="fas fa-laptop-code text-green-600 text-2xl"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-800">Jennifer Lee</h4>
                                            <p class="text-gray-600">Software Developer • San Francisco</p>
                                            <p class="text-sm text-gray-500">Full Stack • 8 years experience</p>
                                        </div>
                                    </div>
                                    <button class="bg-blue-50 text-blue-700 px-4 py-2 rounded-lg font-medium hover:bg-blue-100">
                                        <i class="fas fa-eye mr-2"></i>View Profile
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Tab -->
                    <div id="profileTab" class="tab-content hidden">
                        <div class="text-center py-10">
                            <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-4xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">Your Profile</h3>
                            <p class="text-gray-600 mb-8 max-w-md mx-auto">
                                To view and manage your profile, please login or create an account.
                            </p>
                            <div class="flex gap-4 justify-center">
                                <button  class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700">
                                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                                </button>
                                <button class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-lg font-medium hover:from-blue-700 hover:to-blue-800">
                                    <i class="fas fa-user-plus mr-2"></i>Register Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
    </main>


@endsection