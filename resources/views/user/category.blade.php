@extends('layout.user-layout')

@section('title')
Quick Access - GBS
@endsection

@section('content')
<div id="particles" class="fixed inset-0 pointer-events-none z-0"></div>

<main class="px-4">
    <!-- Breadcrumb -->
    <div class="max-w-7xl mx-auto mb-6">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <i class="fas fa-home mr-2"></i>
                        Home
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 text-sm"></i>
                        <span class="ml-1 md:ml-2 text-sm font-medium text-gray-500">Quick Access</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Header -->
    <section class="max-w-7xl mx-auto mb-10">
        <div class="text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                Quick Access Dashboard
            </h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Access all essential features of GBS Network from one place
            </p>
        </div>
    </section>

    <!-- Quick Access Grid -->
    <section class="max-w-7xl mx-auto mb-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
            
            <!-- News Feed -->
            <a href="{{ route('user') }}" 
               class="subcategory-card bg-white rounded-xl shadow-lg p-8 cursor-pointer hover:shadow-2xl transition-shadow duration-300 border border-transparent">
                <div class="flex items-start mb-6">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-r from-blue-500 to-cyan-500 flex items-center justify-center mr-5 shadow-md">
                        <i class="fas fa-newspaper text-white text-2xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">News Feed</h3>
                        <p class="text-sm text-gray-500 font-medium">Latest Updates & Community Activity</p>
                    </div>
                </div>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Stay updated with real-time posts, announcements, and discussions from professionals across all industries. 
                    Share insights, comment on updates, and engage with the latest trends in your network.
                </p>
                <div class="flex items-center justify-between">
                    <div class="text-blue-600 font-semibold flex items-center">
                        <span>Explore News Feed</span>
                        <i class="fas fa-arrow-right ml-3 text-sm"></i>
                    </div>
                    <span class="text-xs bg-blue-100 text-blue-800 px-3 py-1 rounded-full font-medium">
                        Live Updates
                    </span>
                </div>
            </a>

            <!-- Resource Directory -->
            <a href="{{ route('user') }}" 
               class="subcategory-card bg-white rounded-xl shadow-lg p-8 cursor-pointer hover:shadow-2xl transition-shadow duration-300 border border-transparent">
                <div class="flex items-start mb-6">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-r from-green-500 to-emerald-500 flex items-center justify-center mr-5 shadow-md">
                        <i class="fas fa-folder-open text-white text-2xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Resource </h3>
                        <p class="text-sm text-gray-500 font-medium">Documents, Templates & Tools</p>
                    </div>
                </div>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Access a comprehensive collection of business documents, professional templates, industry reports, 
                    and productivity tools. Contribute your resources and discover valuable materials shared by the community.
                </p>
                <div class="flex items-center justify-between">
                    <div class="text-green-600 font-semibold flex items-center">
                        <span>Browse Resources</span>
                        <i class="fas fa-arrow-right ml-3 text-sm"></i>
                    </div>
                    <span class="text-xs bg-green-100 text-green-800 px-3 py-1 rounded-full font-medium">
                        500+ Files
                    </span>
                </div>
            </a>

          <!-- Directory -->
<a href="{{ route('user') }}" 
   class="subcategory-card bg-white rounded-xl shadow-lg p-8 cursor-pointer hover:shadow-2xl transition-shadow duration-300 border border-transparent">
    <div class="flex items-start mb-6">
        <div class="w-14 h-14 rounded-xl bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center mr-5 shadow-md">
            <i class="fas fa-address-book text-white text-2xl"></i>
        </div>
        <div class="flex-1">
            <h3 class="text-xl font-bold text-gray-800 mb-2">Directory</h3>
            <p class="text-sm text-gray-500 font-medium">Professional Database & Contacts</p>
        </div>
    </div>
    <p class="text-gray-600 mb-6 leading-relaxed">
        Access a comprehensive directory of verified professionals across multiple industries. 
        Search by name, profession, location, or specialization. View detailed profiles with 
        qualifications, experience, services offered, and contact information.
    </p>
    
   
    <div class="flex items-center justify-between">
        <div class="text-purple-600 font-semibold flex items-center">
            <span>Browse Directory</span>
            <i class="fas fa-arrow-right ml-3 text-sm"></i>
        </div>
        <span class="text-xs bg-purple-100 text-purple-800 px-3 py-1 rounded-full font-medium">
            Advanced Search
        </span>
    </div>
</a>

            <!-- My Profile -->
            <a href="{{ route('user') }}" 
               class="subcategory-card bg-white rounded-xl shadow-lg p-8 cursor-pointer hover:shadow-2xl transition-shadow duration-300 border border-transparent">
                <div class="flex items-start mb-6">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-r from-orange-500 to-amber-500 flex items-center justify-center mr-5 shadow-md">
                        <i class="fas fa-id-card text-white text-2xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">My Profile</h3>
                        <p class="text-sm text-gray-500 font-medium">Personal Dashboard</p>
                    </div>
                </div>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Manage your professional identity, update your information, showcase your expertise, 
                    track your network activities, and customize how you appear to other professionals 
                    in the GBS community.
                </p>
                <div class="flex items-center justify-between">
                    <div class="text-orange-600 font-semibold flex items-center">
                        <span>Manage Profile</span>
                        <i class="fas fa-arrow-right ml-3 text-sm"></i>
                    </div>
                    <span class="text-xs bg-orange-100 text-orange-800 px-3 py-1 rounded-full font-medium">
                        Your Account
                    </span>
                </div>
            </a>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="max-w-7xl mx-auto mb-16">
        <div class="bg-gradient-to-r from-gray-50 to-white rounded-2xl shadow-md p-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600 mb-2">10K+</div>
                    <div class="text-sm text-gray-600 font-medium">Active Professionals</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-green-600 mb-2">500+</div>
                    <div class="text-sm text-gray-600 font-medium">Shared Resources</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-purple-600 mb-2">25+</div>
                    <div class="text-sm text-gray-600 font-medium">Industries</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-orange-600 mb-2">1K+</div>
                    <div class="text-sm text-gray-600 font-medium">Daily Updates</div>
                </div>
            </div>
        </div>
    </section>
</main>

@push('styles')
<style>
.subcategory-card {
    transition: box-shadow 0.3s ease;
}

.subcategory-card:hover .fa-arrow-right {
    transform: translateX(8px);
    transition: transform 0.3s ease;
}

.subcategory-card h3 {
    position: relative;
    display: inline-block;
}

.subcategory-card h3::after {
    content: '';
    position: absolute;
    bottom: -4px;
    left: 0;
    width: 0;
    height: 2px;
    background: currentColor;
    transition: width 0.3s ease;
}

.subcategory-card:hover h3::after {
    width: 100%;
}
</style>
@endpush

@endsection