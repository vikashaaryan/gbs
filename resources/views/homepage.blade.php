@extends('layout.user-layout')

@section('title', 'GBS - Homepage')

@section('meta_description')
GBS homepage – explore services, features, and solutions designed to help you grow faster and smarter.
@endsection

@section('meta_keywords')
GBS, homepage, services, business solutions
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
                @forelse($circles as $circle)
                <!-- Dynamic Category Card -->
                <a href="{{ route('subcat') }}" class="category-card bg-white rounded-xl shadow-md p-6 text-center cursor-pointer hover:shadow-lg transition-shadow duration-300">
                    <!-- Icon Container -->
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center" 
                         style="background-color: {{ $circle->color ? $circle->color . '20' : '#EFF6FF' }}">
                        @if($circle->icon)
                            <!-- If icon is stored as font-awesome class -->
                            @if(str_contains($circle->icon, 'fa-'))
                                <i class="{{ $circle->icon }} text-2xl" style="color: {{ $circle->color ? $circle->color : '#3B82F6' }}"></i>
                            <!-- If icon is an image URL -->
                            @elseif(filter_var($circle->icon, FILTER_VALIDATE_URL))
                                <img src="{{ $circle->icon }}" alt="{{ $circle->title }}" class="w-8 h-8">
                            @endif
                        @else
                            <!-- Fallback static icon based on title -->
                            @php
                                $fallbackIcon = 'fas fa-circle';
                                $fallbackColor = '#3B82F6';
                                
                                // Map titles to icons and colors
                                $iconMap = [
                                    'doctor' => ['icon' => 'fas fa-user-md', 'color' => '#3B82F6'],
                                    'medical' => ['icon' => 'fas fa-user-md', 'color' => '#3B82F6'],
                                    'it' => ['icon' => 'fas fa-laptop-code', 'color' => '#10B981'],
                                    'tech' => ['icon' => 'fas fa-laptop-code', 'color' => '#10B981'],
                                    'lawyer' => ['icon' => 'fas fa-gavel', 'color' => '#8B5CF6'],
                                    'legal' => ['icon' => 'fas fa-gavel', 'color' => '#8B5CF6'],
                                    'real estate' => ['icon' => 'fas fa-building', 'color' => '#F97316'],
                                    'property' => ['icon' => 'fas fa-building', 'color' => '#F97316'],
                                    'accountant' => ['icon' => 'fas fa-calculator', 'color' => '#EF4444'],
                                    'finance' => ['icon' => 'fas fa-calculator', 'color' => '#EF4444'],
                                    'consultant' => ['icon' => 'fas fa-chart-line', 'color' => '#14B8A6'],
                                    'business' => ['icon' => 'fas fa-chart-line', 'color' => '#14B8A6'],
                                    'engineer' => ['icon' => 'fas fa-cogs', 'color' => '#6366F1'],
                                    'education' => ['icon' => 'fas fa-graduation-cap', 'color' => '#EC4899'],
                                    'teacher' => ['icon' => 'fas fa-graduation-cap', 'color' => '#EC4899'],
                                ];
                                
                                $titleLower = strtolower($circle->title);
                                $matched = false;
                                
                                foreach($iconMap as $key => $value) {
                                    if(str_contains($titleLower, $key)) {
                                        $fallbackIcon = $value['icon'];
                                        $fallbackColor = $value['color'];
                                        $matched = true;
                                        break;
                                    }
                                }
                                
                                // Default if no match
                                if(!$matched) {
                                    $fallbackIcon = 'fas fa-users';
                                    $fallbackColor = '#6B7280';
                                }
                            @endphp
                            
                            <i class="{{ $fallbackIcon }} text-2xl" style="color: {{ $fallbackColor }}"></i>
                        @endif
                    </div>
                    
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $circle->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ $circle->description ?? 'Professional network and resources' }}</p>
                    <div class="font-medium flex items-center justify-center gap-2" 
                         style="color: {{ $circle->color ? $circle->color : $fallbackColor ?? '#3B82F6' }}">
                        <span>View Circles</span>
                        <i class="fas fa-arrow-right text-sm"></i>
                    </div>
                </a>
                @empty
                <!-- If no circles exist, show a message -->
                <div class="col-span-1 lg:col-span-4 text-center py-8">
                    <p class="text-gray-500 text-lg">No circles available at the moment.</p>
                </div>
                @endforelse
            </div>
        </section>
    </main>

@endsection