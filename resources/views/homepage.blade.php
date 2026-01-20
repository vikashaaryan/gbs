@extends('layout.user-layout')

@section('title')
GBS - Global Business Services
@endsection

@section('content')
<div id="particles" class="fixed inset-0 pointer-events-none z-0"></div>

    <!-- Main Content -->
    <main class=" px-4">
        <!-- Hero Section -->
        <section class="max-w-7xl mx-auto mb-16">
            <div class="text-center ">
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
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Browse Circles</h2>
            
            <!-- Responsive Grid: 1 column on mobile, 2 columns on laptop -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <!-- Category Card 1 -->
                <a href="{{ route('subcat') }}" class="category-card bg-white rounded-xl shadow-md p-6 text-center cursor-pointer hover:shadow-lg transition-shadow duration-300">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-blue-100 flex items-center justify-center">
                        <i class="fas fa-user-md text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Doctors & Medical</h3>
                    <p class="text-gray-600 mb-4">Medical professionals, specialists, healthcare providers</p>
                    <div class="text-blue-600 font-medium flex items-center justify-center gap-2">
                        <span>View Circles</span>
                        <i class="fas fa-arrow-right text-sm"></i>
                    </div>
                </a>

                <!-- Category Card 2 -->
                <a href="{{ route('subcat') }}" class="category-card bg-white rounded-xl shadow-md p-6 text-center cursor-pointer hover:shadow-lg transition-shadow duration-300">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-green-100 flex items-center justify-center">
                        <i class="fas fa-laptop-code text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">IT Professionals</h3>
                    <p class="text-gray-600 mb-4">Developers, designers, tech consultants, IT services</p>
                    <div class="text-green-600 font-medium flex items-center justify-center gap-2">
                        <span>View Circles</span>
                        <i class="fas fa-arrow-right text-sm"></i>
                    </div>
                </a>

                <!-- Category Card 3 -->
                <a href="{{ route('subcat') }}" class="category-card bg-white rounded-xl shadow-md p-6 text-center cursor-pointer hover:shadow-lg transition-shadow duration-300">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-purple-100 flex items-center justify-center">
                        <i class="fas fa-gavel text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Lawyers & Legal</h3>
                    <p class="text-gray-600 mb-4">Legal advisors, attorneys, law firms, consultants</p>
                    <div class="text-purple-600 font-medium flex items-center justify-center gap-2">
                        <span>View Circles</span>
                        <i class="fas fa-arrow-right text-sm"></i>
                    </div>
                </a>

                <!-- Category Card 4 -->
                <a href="{{ route('subcat') }}" class="category-card bg-white rounded-xl shadow-md p-6 text-center cursor-pointer hover:shadow-lg transition-shadow duration-300">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-orange-100 flex items-center justify-center">
                        <i class="fas fa-building text-orange-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Real Estate</h3>
                    <p class="text-gray-600 mb-4">Agents, brokers, property consultants, developers</p>
                    <div class="text-orange-600 font-medium flex items-center justify-center gap-2">
                        <span>View Circles</span>
                        <i class="fas fa-arrow-right text-sm"></i>
                    </div>
                </a>

                <!-- Category Card 5 -->
                <a href="{{ route('subcat') }}" class="category-card bg-white rounded-xl shadow-md p-6 text-center cursor-pointer hover:shadow-lg transition-shadow duration-300">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-red-100 flex items-center justify-center">
                        <i class="fas fa-calculator text-red-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Accountants</h3>
                    <p class="text-gray-600 mb-4">CA, tax consultants, auditors, financial advisors</p>
                    <div class="text-red-600 font-medium flex items-center justify-center gap-2">
                        <span>View Circles</span>
                        <i class="fas fa-arrow-right text-sm"></i>
                    </div>
                </a>

                <!-- Category Card 6 -->
                <a href="{{ route('subcat') }}" class="category-card bg-white rounded-xl shadow-md p-6 text-center cursor-pointer hover:shadow-lg transition-shadow duration-300">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-teal-100 flex items-center justify-center">
                        <i class="fas fa-chart-line text-teal-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Business Consultants</h3>
                    <p class="text-gray-600 mb-4">Management, marketing, HR, strategy consultants</p>
                    <div class="text-teal-600 font-medium flex items-center justify-center gap-2">
                        <span>View Circles</span>
                        <i class="fas fa-arrow-right text-sm"></i>
                    </div>
                </a>

                <!-- Category Card 7 -->
                <a href="{{ route('subcat') }}" class="category-card bg-white rounded-xl shadow-md p-6 text-center cursor-pointer hover:shadow-lg transition-shadow duration-300">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-indigo-100 flex items-center justify-center">
                        <i class="fas fa-cogs text-indigo-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Engineers</h3>
                    <p class="text-gray-600 mb-4">Civil, mechanical, electrical, software engineers</p>
                    <div class="text-indigo-600 font-medium flex items-center justify-center gap-2">
                        <span>View Circles</span>
                        <i class="fas fa-arrow-right text-sm"></i>
                    </div>
                </a>

                <!-- Category Card 8 -->
                <a href="{{ route('subcat') }}" class="category-card bg-white rounded-xl shadow-md p-6 text-center cursor-pointer hover:shadow-lg transition-shadow duration-300">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-pink-100 flex items-center justify-center">
                        <i class="fas fa-graduation-cap text-pink-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Education</h3>
                    <p class="text-gray-600 mb-4">Teachers, tutors, trainers, educational institutes</p>
                    <div class="text-pink-600 font-medium flex items-center justify-center gap-2">
                        <span>View Circles</span>
                        <i class="fas fa-arrow-right text-sm"></i>
                    </div>
                </a>
            </div>
        </section>
    </main>

@endsection