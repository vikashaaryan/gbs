@extends('layout.user-layout')

@section('title', 'GBS - Section')

@section('meta_description')
GBS section page – detailed information, features, and resources tailored for this specific section.
@endsection

@section('meta_keywords')
GBS, section, features, services
@endsection

@section('content')

    <div id="particles" class="fixed inset-0 pointer-events-none z-0"></div>

    <main class="min-h-screen">
        <!-- Breadcrumb -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}"
                           class="inline-flex items-center text-sm text-gray-600 hover:text-blue-700">
                            <i class="fas fa-home mr-2"></i>
                            Home
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 text-xs mx-2"></i>
                            <span class="text-sm font-medium text-gray-500">Quick Access</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Header -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-12 md:mb-16">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                Quick Access
            </h1>
            <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto">
                Essential GBS features at a glance
            </p>
        </section>

        <!-- Main Grid -->
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6 md:gap-14">

                <!-- News Feed -->
                <a href="{{ route('user') }}#newsfeed"
                   class="group bg-white rounded-2xl shadow hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col items-center text-center p-10 md:p-12">
                    <div class="w-24 h-24 md:w-28 md:h-28 rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-600 flex items-center justify-center mb-6 shadow-lg group-hover:scale-105 transition-transform duration-300">
                        <i class="fas fa-newspaper text-white text-5xl md:text-6xl"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-semibold text-gray-800 mb-3">News Feed</h3>
                    <p class="text-gray-600 text-base">Latest updates & community activity</p>
                </a>

                <!-- Resources -->
                <a href="{{ route('user') }}#resources"
                   class="group bg-white rounded-2xl shadow hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col items-center text-center p-10 md:p-12">
                    <div class="w-24 h-24 md:w-28 md:h-28 rounded-2xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center mb-6 shadow-lg group-hover:scale-105 transition-transform duration-300">
                        <i class="fas fa-folder-open text-white text-5xl md:text-6xl"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-semibold text-gray-800 mb-3">Resources</h3>
                    <p class="text-gray-600 text-base">Documents, templates & tools</p>
                </a>

                <!-- Directory -->
                <a href="{{ route('user') }}#directory"
                   class="group bg-white rounded-2xl shadow hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col items-center text-center p-10 md:p-12">
                    <div class="w-24 h-24 md:w-28 md:h-28 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-600 flex items-center justify-center mb-6 shadow-lg group-hover:scale-105 transition-transform duration-300">
                        <i class="fas fa-address-book text-white text-5xl md:text-6xl"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-semibold text-gray-800 mb-3">Directory</h3>
                    <p class="text-gray-600 text-base">Professionals & contacts</p>
                </a>

                <!-- My Profile -->
                <a href="{{ route('user') }}#profile"
                   class="group bg-white rounded-2xl shadow hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden flex flex-col items-center text-center p-10 md:p-12">
                    <div class="w-24 h-24 md:w-28 md:h-28 rounded-2xl bg-gradient-to-br from-orange-500 to-amber-600 flex items-center justify-center mb-6 shadow-lg group-hover:scale-105 transition-transform duration-300">
                        <i class="fas fa-id-card text-white text-5xl md:text-6xl"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-semibold text-gray-800 mb-3">My Profile</h3>
                    <p class="text-gray-600 text-base">Manage your account & visibility</p>
                </a>

            </div>
        </section>

        <!-- Stats -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-16 md:mt-20">
            <div class="bg-gray-50 rounded-2xl p-8 md:p-10 shadow-sm">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                    <div>
                        <div class="text-3xl md:text-4xl font-bold text-blue-700">10K+</div>
                        <div class="text-sm text-gray-600 mt-1">Professionals</div>
                    </div>
                    <div>
                        <div class="text-3xl md:text-4xl font-bold text-green-700">500+</div>
                        <div class="text-sm text-gray-600 mt-1">Resources</div>
                    </div>
                    <div>
                        <div class="text-3xl md:text-4xl font-bold text-purple-700">25+</div>
                        <div class="text-sm text-gray-600 mt-1">Industries</div>
                    </div>
                    <div>
                        <div class="text-3xl md:text-4xl font-bold text-orange-700">1K+</div>
                        <div class="text-sm text-gray-600 mt-1">Daily posts</div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @push('styles')
        <style>
            .group:hover {
                transform: translateY(-4px);
            }
        </style>
    @endpush
@endsection