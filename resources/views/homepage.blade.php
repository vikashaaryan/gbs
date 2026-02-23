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
<main class="px-4">
    <!-- Hero Section -->
    <section class="max-w-7xl mx-auto mb-16">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                Welcome to <span class="text-teal-600">GBS </span>
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Connect with professionals across various industries. Find experts, resources, and build your network.
            </p>
        </div>
    </section>

    <!-- Location Search Results Message -->
    @if(isset($isFiltered) && $isFiltered)
    <div class="max-w-7xl mx-auto mb-8">
        <div class="bg-teal-50 border-l-4 border-teal-500 p-4 rounded-lg shadow-sm">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center gap-3">
                    <div class="bg-teal-100 p-2 rounded-full">
                        <i class="fas fa-map-marker-alt text-teal-600"></i>
                    </div>
                    <div>
                        <p class="text-teal-700 font-medium">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            Searching in: <span class="font-bold text-teal-800">"{{ $locationTerm }}"</span>
                        </p>
                        @if(isset($locationExists) && !$locationExists)
                            <p class="text-amber-600 mt-1">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                No circles found in this location yet.
                            </p>
                        @elseif(isset($locationExists) && $locationExists)
                            <p class="text-green-600 mt-1">
                                <i class="fas fa-check-circle mr-2"></i>
                                Found {{ $circles->count() }} {{ Str::plural('circle', $circles->count()) }} in this location.
                            </p>
                        @endif
                    </div>
                </div>
                <a href="{{ route('home') }}" 
                   class="flex items-center gap-2 px-4 py-2 bg-white text-gray-600 hover:text-gray-800 rounded-lg border border-gray-300 hover:border-gray-400 transition-all">
                    <i class="fas fa-times"></i>
                    Clear Filter
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Categories Grid -->
    <section class="max-w-7xl mx-auto mb-16">
        <div class="flex justify-center items-center mb-8">
            <h2 class="text-3xl font-bold text-center text-gray-800">Browse Circles</h2>
            @if(isset($isFiltered) && $isFiltered && $circles->count() > 0)
                <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                    {{ $circles->count() }} {{ Str::plural('circle', $circles->count()) }} found
                </span>
            @endif
        </div>
        
        <!-- Responsive Grid: 4 columns on laptop -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($circles as $circle)
            @php
                // Define icon and color for each circle
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
                
                $fallbackIcon = 'fas fa-users';
                $fallbackColor = '#6B7280';
                $titleLower = strtolower($circle->title);
                
                foreach($iconMap as $key => $value) {
                    if(str_contains($titleLower, $key)) {
                        $fallbackIcon = $value['icon'];
                        $fallbackColor = $value['color'];
                        break;
                    }
                }
                
                // Use circle color if available, otherwise use fallback
                $displayColor = $circle->color ?? $fallbackColor;
                
                // Get location display
                $locationDisplay = '';
                if ($circle->location) {
                    $loc = $circle->location;
                    $parts = [];
                    if (!empty($loc['city']) && $loc['city'] !== 'null') $parts[] = $loc['city'];
                    if (!empty($loc['state']) && $loc['state'] !== 'null') $parts[] = $loc['state'];
                    if (!empty($loc['country']) && $loc['country'] !== 'null') $parts[] = $loc['country'];
                    $locationDisplay = implode(', ', $parts);
                }
            @endphp
            
            <!-- Dynamic Category Card -->
            <a href="{{ route('subcat') }}" class="category-card bg-white rounded-xl shadow-md p-6 text-center cursor-pointer hover:shadow-lg transition-all duration-300 border border-gray-100 hover:border-teal-200 group">
                <!-- Icon Container -->
                <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300" 
                     style="background-color: {{ $circle->color ? $circle->color . '20' : '#EFF6FF' }}">
                    @if($circle->icon)
                        @if(str_contains($circle->icon, 'fa-'))
                            <i class="{{ $circle->icon }} text-2xl" style="color: {{ $displayColor }}"></i>
                        @elseif(filter_var($circle->icon, FILTER_VALIDATE_URL))
                            <img src="{{ $circle->icon }}" alt="{{ $circle->title }}" class="w-8 h-8">
                        @endif
                    @else
                        <i class="{{ $fallbackIcon }} text-2xl" style="color: {{ $displayColor }}"></i>
                    @endif
                </div>
                
                <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $circle->title }}</h3>
                <p class="text-gray-600 text-sm mb-4">{{ $circle->description ?? 'Professional network and resources' }}</p>
                
                <!-- Show location if available -->
                @if($locationDisplay)
                    <div class="text-sm text-gray-500 mb-3 bg-gray-50 py-2 px-3 rounded-lg border border-gray-100">
                        <i class="fas fa-map-marker-alt mr-1 text-teal-500"></i>
                        {{ $locationDisplay }}
                    </div>
                    
                @endif
                
              
            </a>
            @empty
            <!-- If no circles exist, show a message -->
            <div class="col-span-1 sm:col-span-2 lg:col-span-4 text-center py-12">
                <div class="bg-gray-50 rounded-xl p-8 max-w-md mx-auto border border-gray-200">
                    <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-map-marked-alt text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No Circles Found</h3>
                    @if(isset($isFiltered) && $isFiltered)
                        <p class="text-gray-500 mb-4">
                            We couldn't find any circles in <span class="font-semibold text-teal-600">"{{ $locationTerm }}"</span>.
                        </p>
                        <p class="text-gray-400 text-sm mb-6">
                            Try searching for a different location or browse all circles.
                        </p>
                        <a href="{{ route('home') }}" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors">
                            <i class="fas fa-times"></i>
                            Clear Filter
                        </a>
                    @else
                        <p class="text-gray-500 mb-4">No circles available at the moment.</p>
                        <p class="text-gray-400 text-sm">Check back later for updates.</p>
                    @endif
                </div>
            </div>
            @endforelse
        </div>
        
        <!-- Show "View All" button when filtered and results exist -->
        @if(isset($isFiltered) && $isFiltered && $circles->count() > 0)
        <div class="text-center mt-10">
            <a href="{{ route('home') }}" 
               class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                <i class="fas fa-arrow-left"></i>
                View All Circles
            </a>
        </div>
        @endif
    </section>
    
</main>
@endsection