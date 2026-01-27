@extends('layout.user-layout')

@section('title', 'GBS - Feed Resource Panel Directory Profile')

@section('meta_description')
    GBS feed resource panel directory profile – view detailed profile information, resources, and activity in one place.
@endsection

@section('meta_keywords')
    GBS, feed, resource panel, directory, profile
@endsection

@section('content')
    <!-- Tabs Navigation - Fixed Sticky -->
    <div class="sticky md:top-20 top-17 -mt-8 md:-mt-15  z-50 bg-white    sm:px-6 lg:px-1 ">

        <div class="flex overflow-x-auto py-3 md:px-32 px-4 gap-2 sm:gap-6 scrollbar-hide">
            <button onclick="switchTab('newsfeed')"
                class="tab-button active flex items-center gap-2 px-5 py-2.5 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition">
                <i class="fas fa-newspaper"></i>
                <span class="hidden md:inline">News Feed</span>
                <span class="md:hidden">Feed</span>
            </button>
            <button onclick="switchTab('resources')"
                class="tab-button flex items-center gap-2 px-5 py-2.5 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition">
                <i class="fas fa-book"></i> Resources
            </button>
            <button onclick="switchTab('directory')"
                class="tab-button flex items-center gap-2 px-5 py-2.5 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition">
                <i class="fas fa-address-book"></i> Directory
            </button>
            <button onclick="switchTab('profile')"
                class="tab-button flex items-center gap-2 px-5 py-2.5 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition">
                <i class="fas fa-user"></i> Profile
            </button>
        </div>
    </div>
    <!-- Tab Content -->
    <div class="px-4 sm:px-6 md:mx-12 lg:px-12 py-6 mb-8">
        <!-- News Feed Tab - Facebook Style -->
        <div id="newsfeed" class="tab-content">
            <div class="max-w-2xl mx-auto">
                <!-- Create Post Box -->
                <div class="bg-white rounded-xl shadow-md p-4 mb-6 border border-gray-200">
                    <div class="flex items-center mb-4">
                        <div
                            class="w-10 h-10 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-user text-white"></i>
                        </div>
                        <textarea id="postContent" class="flex-1 p-3 border border-gray-300 rounded-lg text-sm sm:text-base" rows="2"
                            placeholder="What's on your mind, John?"></textarea>
                    </div>

                    <!-- Preview Section -->
                    <div id="previewSection" class="mb-3 hidden">
                        <div id="mediaPreview" class="relative mb-2"></div>
                        <button type="button" id="removeMediaBtn" class="text-red-600 text-sm hover:text-red-800">
                            <i class="fas fa-times mr-1"></i>Remove file
                        </button>
                    </div>

                    <div class="border-t pt-3">
                        <!-- Hidden File Inputs -->
                        <input type="file" id="imageInput" accept="image/*" class="hidden">
                        <input type="file" id="videoInput" accept="video/*" class="hidden">
                        <input type="file" id="fileInput" accept=".pdf,.doc,.docx,.txt,.mp3,.wav,.m4a" class="hidden">

                        <div class="flex flex-wrap gap-2">
                            <button type="button" onclick="openFilePicker('image')"
                                class="flex items-center gap-2 px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors touch-target">
                                <i class="fas fa-image text-green-600"></i>
                                <span class="text-sm font-medium">Photo</span>
                            </button>
                            <button type="button" onclick="openFilePicker('video')"
                                class="flex items-center gap-2 px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors touch-target">
                                <i class="fas fa-video text-red-600"></i>
                                <span class="text-sm font-medium">Video</span>
                            </button>
                            <button type="button" onclick="openFilePicker('audio')"
                                class="flex items-center gap-2 px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors touch-target">
                                <i class="fas fa-music text-purple-600"></i>
                                <span class="text-sm font-medium">Audio</span>
                            </button>
                            <button type="button" onclick="openFilePicker('document')"
                                class="flex items-center gap-2 px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors touch-target">
                                <i class="fas fa-file text-blue-600"></i>
                                <span class="text-sm font-medium">Document</span>
                            </button>
                            <button type="button" onclick="showDummyEvent()"
                                class="flex items-center gap-2 px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors touch-target">
                                <i class="fas fa-calendar text-orange-600"></i>
                                <span class="text-sm font-medium">Event</span>
                            </button>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4 flex justify-end">
                            <button type="button" onclick="createDummyPost()"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition-colors">
                                Post
                            </button>
                        </div>
                    </div>
                </div>


                <!-- Dummy Posts -->
                <!-- Post 1: Image Post -->
                <div class="bg-white rounded-xl shadow-md mb-6 overflow-hidden border border-gray-200">
                    <!-- Post Header -->
                    <div class="p-4">
                        <div class="flex items-center">
                            <div
                                class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user-md text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Dr. Sarah Johnson</h4>
                                <p class="text-sm text-gray-500">Cardiologist • 2 hours ago</p>
                            </div>
                        </div>
                        <p class="mt-3 text-gray-700">Just completed a successful heart surgery at City Hospital. The
                            patient is recovering well. So grateful for my amazing team! ❤️🏥 #Cardiology #MedicalSuccess
                        </p>
                    </div>

                    <!-- Post Image -->
                    <div class="border-t border-gray-100">
                        <img src="https://images.unsplash.com/photo-1551601651-2a8555f1a136?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80"
                            alt="Medical Team" class="w-full h-64 object-cover">
                        <div class="p-3 bg-gray-50">
                            <p class="text-sm text-gray-600"><i class="fas fa-hospital mr-2 text-blue-500"></i>City Hospital
                                - Cardiac Wing</p>
                        </div>
                    </div>

                    <!-- Post Stats -->
                    <div class="px-4 py-3 border-t border-gray-100">
                        <div class="flex items-center justify-between text-gray-500 text-sm">
                            <div class="flex items-center space-x-4">
                                <span class="flex items-center">
                                    <i class="fas fa-thumbs-up text-blue-500 mr-1"></i> 245
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-comment mr-1"></i> 42
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-share mr-1"></i> 18
                                </span>
                            </div>
                            <span>2.4k views</span>
                        </div>
                    </div>

                    <!-- Post Actions -->
                    <div class="border-t border-gray-100">
                        <div class="flex">
                            <button class="flex-1 py-3 text-center hover:bg-gray-50 transition-colors">
                                <i class="far fa-thumbs-up mr-2"></i> Like
                            </button>
                            <button class="flex-1 py-3 text-center hover:bg-gray-50 transition-colors">
                                <i class="far fa-comment mr-2"></i> Comment
                            </button>
                            <button class="flex-1 py-3 text-center hover:bg-gray-50 transition-colors">
                                <i class="far fa-share-square mr-2"></i> Share
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Post 2: Video Post -->
                <div class="bg-white rounded-xl shadow-md mb-6 overflow-hidden border border-gray-200">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div
                                class="w-10 h-10 bg-gradient-to-r from-green-500 to-teal-500 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-laptop-code text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Alex Chen</h4>
                                <p class="text-sm text-gray-500">Software Architect • 5 hours ago</p>
                            </div>
                        </div>
                        <p class="mt-3 text-gray-700">Just launched our new AI-powered diagnostic tool for healthcare
                            providers! 🚀 Check out the demo video below. Looking for beta testers from the medical
                            community!</p>
                    </div>

                    <!-- Video Thumbnail -->
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1555255707-c07966088b7b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80"
                            alt="AI Diagnostic Tool" class="w-full h-64 object-cover">
                        <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30">
                            <button onclick="playDummyVideo('video1')"
                                class="w-16 h-16 bg-white bg-opacity-90 rounded-full flex items-center justify-center hover:bg-opacity-100 transition-all">
                                <i class="fas fa-play text-blue-600 text-2xl"></i>
                            </button>
                        </div>
                    </div>

                    <div class="p-4 border-t border-gray-100">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span><i class="fas fa-eye mr-1"></i> 3.2k views</span>
                                <span><i class="fas fa-clock mr-1"></i> 4:32 min</span>
                            </div>
                            <button onclick="playDummyVideo('video1')" class="text-blue-600 text-sm font-medium">
                                <i class="fas fa-external-link-alt mr-1"></i> Watch Full Video
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Post 3: Audio Post -->
                <div class="bg-white rounded-xl shadow-md mb-6 overflow-hidden border border-gray-200">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div
                                class="w-10 h-10 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-microphone-alt text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Mark Wilson</h4>
                                <p class="text-sm text-gray-500">Business Coach • 1 day ago</p>
                            </div>
                        </div>
                        <p class="mt-3 text-gray-700">Just recorded a new podcast episode on "Leadership in Digital
                            Transformation".
                            Listen to the full episode below and share your thoughts!</p>
                    </div>

                    <!-- Audio Player -->
                    <div class="px-4 pb-4">
                        <div class="bg-gradient-to-r from-purple-50 to-indigo-50 rounded-xl p-4">
                            <div class="flex items-center mb-3">
                                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-podcast text-purple-600 text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-800">Leadership Strategies 2024</h4>
                                    <p class="text-sm text-gray-500">Podcast • 35:42 min</p>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">0:00</span>
                                    <div class="flex-1 mx-4">
                                        <div class="w-full bg-gray-200 rounded-full h-1.5">
                                            <div class="bg-purple-600 h-1.5 rounded-full" style="width: 45%"></div>
                                        </div>
                                    </div>
                                    <span class="text-sm text-gray-500">35:42</span>
                                </div>
                                <div class="flex items-center justify-center space-x-6">
                                    <button class="text-gray-500 hover:text-purple-600">
                                        <i class="fas fa-step-backward text-lg"></i>
                                    </button>
                                    <button onclick="playDummyAudio('audio1')"
                                        class="w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center hover:bg-purple-700">
                                        <i class="fas fa-play"></i>
                                    </button>
                                    <button class="text-gray-500 hover:text-purple-600">
                                        <i class="fas fa-step-forward text-lg"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Post 4: PDF Document Post -->
                <div class="bg-white rounded-xl shadow-md mb-6 overflow-hidden border border-gray-200">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div
                                class="w-10 h-10 bg-gradient-to-r from-red-500 to-orange-500 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-file-pdf text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Dr. Lisa Wong</h4>
                                <p class="text-sm text-gray-500">Healthcare Consultant • 3 days ago</p>
                            </div>
                        </div>
                        <p class="mt-3 text-gray-700">Just published my latest research paper on "AI in Medical
                            Diagnostics".
                            Sharing the complete PDF for fellow researchers and practitioners.</p>

                        <!-- PDF Document -->
                        <div class="mt-4 bg-gradient-to-r from-red-50 to-orange-50 rounded-xl p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-file-pdf text-red-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-800">AI in Medical Diagnostics - 2024.pdf</h4>
                                        <p class="text-sm text-gray-500">Research Paper • 2.4 MB • 28 pages</p>
                                    </div>
                                </div>
                                <button onclick="viewDummyPDF('pdf1')"
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium">
                                    <i class="fas fa-eye mr-1"></i> View PDF
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Post 5: Text Only with Links -->
                <div class="bg-white rounded-xl shadow-md mb-6 overflow-hidden border border-gray-200">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div
                                class="w-10 h-10 bg-gradient-to-r from-orange-500 to-amber-500 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-chart-line text-white"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Rajesh Kumar</h4>
                                <p class="text-sm text-gray-500">Business Consultant • 1 day ago</p>
                            </div>
                        </div>
                        <p class="mt-3 text-gray-700">Just published my latest article on "Digital Transformation in
                            Healthcare". Key insights:</p>
                        <ul class="mt-2 space-y-1 text-gray-600">
                            <li>• AI adoption increased by 300% in 2023</li>
                            <li>• Telemedicine now covers 65% of consultations</li>
                            <li>• Digital health market to reach $500B by 2025</li>
                        </ul>
                        <div class="mt-4 p-3 bg-blue-50 rounded-lg border border-blue-100">
                            <p class="text-sm text-blue-800">
                                <i class="fas fa-link mr-2"></i>
                                Read full article: <a href="#"
                                    class="underline font-medium">healthcare-digital-2024.com</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Resources Tab - Enhanced -->
        <div id="resources" class="tab-content hidden">
            <div class="max-w-6xl mx-auto">
                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Professional Resources</h3>
                    <p class="text-gray-600">Curated materials, templates, and tools for business professionals</p>
                </div>

                <!-- Resource Categories -->
                <div class="flex flex-wrap gap-2 mb-8">
                    <button onclick="filterResources('all')"
                        class="px-4 py-2 bg-blue-600 text-white rounded-full text-sm font-medium transition-colors">
                        All Resources
                    </button>
                    <button onclick="filterResources('audio')"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-200 transition-colors">
                        <i class="fas fa-music mr-1"></i> Audio
                    </button>
                    <button onclick="filterResources('video')"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-200 transition-colors">
                        <i class="fas fa-video mr-1"></i> Video
                    </button>
                    <button onclick="filterResources('pdf')"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-200 transition-colors">
                        <i class="fas fa-file-pdf mr-1"></i> PDF
                    </button>
                    <button onclick="filterResources('image')"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-200 transition-colors">
                        <i class="fas fa-image mr-1"></i> Images
                    </button>
                </div>

                <!-- Resources Grid -->
                <div id="resourcesGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Resource 1: Audio Resource -->
                    <div class="resource-card bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300"
                        data-type="audio">
                        <div class="p-6">
                            <div class="flex items-start mb-4">
                                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-podcast text-purple-600 text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 mb-1">Leadership Podcast Series</h4>
                                    <p class="text-sm text-gray-500">Audio • 12 Episodes • 8.5 hrs</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">Complete podcast series on modern leadership, team
                                management, and organizational psychology.</p>

                            <!-- Audio Preview -->
                            <div class="mb-4 p-3 bg-purple-50 rounded-lg">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-gray-700">Episode 1: Visionary Leadership</span>
                                    <span class="text-xs text-gray-500">25:18</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button onclick="playDummyAudio('resource1')"
                                        class="text-purple-600 hover:text-purple-700">
                                        <i class="fas fa-play-circle text-lg"></i>
                                    </button>
                                    <div class="flex-1 bg-gray-200 rounded-full h-1.5">
                                        <div class="bg-purple-500 h-1.5 rounded-full" style="width: 30%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-headphones mr-1"></i> 2.4k listens
                                </div>
                                <button onclick="playDummyAudio('resource1')"
                                    class="text-purple-600 font-medium hover:text-purple-700 text-sm">
                                    <i class="fas fa-play mr-1"></i> Play Now
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Resource 2: Video Course -->
                    <div class="resource-card bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300"
                        data-type="video">
                        <div class="p-6">
                            <div class="flex items-start mb-4">
                                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-video text-red-600 text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 mb-1">Digital Marketing Masterclass</h4>
                                    <p class="text-sm text-gray-500">Video Course • 6 Hours</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">Complete guide to digital marketing strategies, SEO,
                                social media, and analytics.</p>

                            <!-- Video Thumbnail -->
                            <div class="mb-4 relative">
                                <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
                                    alt="Digital Marketing" class="w-full h-32 object-cover rounded-lg">
                                <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-20">
                                    <button onclick="playDummyVideo('resource2')"
                                        class="w-10 h-10 bg-white rounded-full flex items-center justify-center hover:bg-gray-100">
                                        <i class="fas fa-play text-red-600"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="flex items-center text-sm text-gray-500 mb-1">
                                    <i class="fas fa-star text-yellow-500 mr-1"></i> 4.8 • 342 reviews
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: 85%"></div>
                                </div>
                            </div>
                            <button onclick="playDummyVideo('resource2')"
                                class="w-full bg-red-600 text-white py-2 rounded-lg font-medium hover:bg-red-700 transition-colors">
                                <i class="fas fa-play-circle mr-2"></i> Start Course
                            </button>
                        </div>
                    </div>

                    <!-- Resource 3: PDF Guide -->
                    <div class="resource-card bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300"
                        data-type="pdf">
                        <div class="p-6">
                            <div class="flex items-start mb-4">
                                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-file-pdf text-red-600 text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 mb-1">Business Plan Template 2024</h4>
                                    <p class="text-sm text-gray-500">PDF • 15 Pages • 2.4 MB</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">Complete business plan template with financial
                                projections, market analysis, and executive summary.</p>

                            <!-- PDF Preview -->
                            <div class="mb-4 p-3 bg-red-50 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                                        <span class="text-sm text-gray-700">Preview available</span>
                                    </div>
                                    <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded">Editable</span>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-download mr-1"></i> 1,245 downloads
                                </div>
                                <button onclick="viewDummyPDF('resource3')"
                                    class="text-red-600 font-medium hover:text-red-700 text-sm">
                                    <i class="fas fa-eye mr-1"></i> View PDF
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Resource 4: Image Collection -->
                    <div class="resource-card bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300"
                        data-type="image">
                        <div class="p-6">
                            <div class="flex items-start mb-4">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-images text-green-600 text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 mb-1">Professional Presentation Images</h4>
                                    <p class="text-sm text-gray-500">Image Collection • 150+ Files</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">High-quality images, infographics, and charts for
                                professional presentations and reports.</p>

                            <!-- Image Gallery Preview -->
                            <div class="mb-4 grid grid-cols-3 gap-1">
                                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80"
                                    alt="Chart 1" class="h-16 object-cover rounded">
                                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80"
                                    alt="Chart 2" class="h-16 object-cover rounded">
                                <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80"
                                    alt="Chart 3" class="h-16 object-cover rounded">
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-500">
                                    <i class="fas fa-folder mr-1"></i> 8 Categories
                                </div>
                                <button onclick="viewDummyImages()"
                                    class="text-green-600 font-medium hover:text-green-700 text-sm">
                                    <i class="fas fa-images mr-1"></i> Browse Images
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Resource 5: Audio Book -->
                    <div class="resource-card bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300"
                        data-type="audio">
                        <div class="p-6">
                            <div class="flex items-start mb-4">
                                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-book-audio text-indigo-600 text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 mb-1">Business Strategy Audio Book</h4>
                                    <p class="text-sm text-gray-500">Audio Book • 12 hrs 45 min</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">Complete audio book on business strategy, market
                                positioning, and competitive advantage.</p>

                            <!-- Audio Controls -->
                            <div class="mb-4 p-3 bg-indigo-50 rounded-lg">
                                <div class="flex items-center space-x-2">
                                    <button onclick="playDummyAudio('resource5')"
                                        class="text-indigo-600 hover:text-indigo-700">
                                        <i class="fas fa-play-circle text-xl"></i>
                                    </button>
                                    <div class="flex-1">
                                        <div class="flex justify-between text-xs text-gray-500 mb-1">
                                            <span>Chapter 3</span>
                                            <span>45:30 / 68:15</span>
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-1.5">
                                            <div class="bg-indigo-500 h-1.5 rounded-full" style="width: 66%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-bookmark mr-1"></i> 24 Chapters
                                </div>
                                <button onclick="playDummyAudio('resource5')"
                                    class="text-indigo-600 font-medium hover:text-indigo-700 text-sm">
                                    <i class="fas fa-play mr-1"></i> Listen Now
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Resource 6: Video Tutorial -->
                    <div class="resource-card bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300"
                        data-type="video">
                        <div class="p-6">
                            <div class="flex items-start mb-4">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-film text-blue-600 text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 mb-1">Excel Advanced Tutorials</h4>
                                    <p class="text-sm text-gray-500">Video Series • 4.5 Hours</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">Step-by-step video tutorials covering advanced Excel
                                functions, formulas, and data analysis.</p>

                            <!-- Video Stats -->
                            <div class="mb-4 space-y-2">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600">32 Tutorials</span>
                                    <span class="text-blue-600 font-medium">Beginner to Advanced</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-check-circle text-green-500 mr-1"></i>
                                    <span>Downloadable exercise files included</span>
                                </div>
                            </div>

                            <button onclick="playDummyVideo('resource6')"
                                class="w-full bg-blue-600 text-white py-2 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                                <i class="fas fa-play mr-2"></i> Watch Tutorials
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Directory Tab - Enhanced -->
        <div id="directory" class="tab-content hidden">
            <div class="max-w-6xl mx-auto">
                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Professional Directory</h3>
                    <p class="text-gray-600">Connect with verified professionals across industries</p>
                </div>

                <div class="max-w-6xl mx-auto mb-8">
                    <!-- Filters -->
                    <!-- Filters -->
                    <div class="bg-white rounded-xl shadow-md p-3 sm:p-4 mb-4 sm:mb-6 border border-gray-200">
                        <div class="flex flex-wrap gap-2 sm:gap-3">
                            <!-- Sort by - Always visible -->
                            <div class="relative w-full sm:w-auto sm:flex-1 min-w-[150px] max-w-[200px]">
                                <select
                                    class="appearance-none bg-white border border-gray-300 rounded-lg pl-3 sm:pl-4 pr-8 sm:pr-10 py-2 sm:py-2.5 text-sm sm:text-base text-gray-700 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option>Sort by</option>
                                    <option>Old</option>
                                    <option>New</option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <i class="fas fa-chevron-down text-sm sm:text-base"></i>
                                </div>
                            </div>

                            <div>
                                <select id="country" name="country" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('country') border-red-500 @enderror">
                                    <option value="">Select Country</option>
                                </select>
                               
                            </div>

                            <!-- State -->
                            <div>
                                <select id="state" name="state" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('state') border-red-500 @enderror">
                                    <option value="">Select State</option>
                                </select>
                               
                            </div>

                            <!-- District -->
                            <div>
                                <select id="district" name="district" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('district') border-red-500 @enderror">
                                    <option value="">Select District</option>
                                </select>
                              
                            </div>
                            
                        </div>
                    </div>
                </div>

                <!-- Hotel Listings -->
                <div class="max-w-6xl mx-auto">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Main Hotel Listings -->
                        <div class="lg:col-span-2">
                            <!-- Hotel 1 -->
                            <div class="bg-white rounded-xl shadow-md mb-6 overflow-hidden border border-gray-200">
                                <div class="p-6">
                                    <div class="flex flex-col md:flex-row md:items-start gap-6">
                                        <!-- Hotel Image -->
                                        <div class="md:w-1/3">
                                            <div class="relative h-48 md:h-40 rounded-lg overflow-hidden">
                                                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                                                    alt="Hotel Green Star Hospitality" class="w-full h-full object-cover">
                                                <div class="absolute top-3 left-3">
                                                    <span
                                                        class="bg-green-600 text-white text-xs font-bold px-2 py-1 rounded">
                                                        Trust Verified
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Hotel Details -->
                                        <div class="md:w-2/3">
                                            <div class="flex justify-between items-start mb-3">

                                                <div class="text-right">
                                                    <div class="text-green-600 text-sm font-medium mb-1">
                                                        <i class="fas fa-bolt mr-1"></i>Responsive
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Location & Amenities -->
                                            <div class="mb-4">
                                                <div class="flex flex-wrap gap-2">
                                                    <span
                                                        class="inline-flex items-center text-sm bg-gray-100 text-gray-700 px-3 py-1 rounded-full">
                                                        Business Name
                                                    </span>
                                                    <span
                                                        class="inline-flex items-center text-sm bg-gray-100 text-gray-700 px-3 py-1 rounded-full">
                                                        Bio
                                                    </span> <span
                                                        class="inline-flex items-center text-sm bg-gray-100 text-gray-700 px-3 py-1 rounded-full">
                                                        About Me
                                                    </span>

                                                </div>
                                                <div class="flex items-center text-gray-600 mb-2">
                                                    <i class="fas fa-map-marker-alt mr-2 text-red-500"></i>
                                                    <span>Marve Road Malad West, Mumbai</span>
                                                </div>

                                            </div>

                                            <!-- Contact & Actions -->
                                            <div
                                                class="flex flex-col md:flex-row md:items-center justify-between pt-4 border-t border-gray-200">
                                                <div class="mb-4 md:mb-0">
                                                    <div class="text-gray-700  flex-1 gap-3 flex font-medium mb-2">
                                                        <i class="fas fa-phone-alt text-blue-600"></i>09054813935
                                                        <button class="text-green-600 hover:text-green-700 font-medium">
                                                            <i class="fab fa-whatsapp mr-1"></i>WhatsApp
                                                        </button>
                                                        <button class="text-blue-600 hover:text-blue-700 font-medium">
                                                            <i class="fas fa-envelope mr-1"></i>Email
                                                        </button>
                                                    </div>

                                                </div>
                                                <button
                                                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-6 rounded-lg transition-colors">
                                                    <i class="fas fa-shopping-cart mr-2"></i>Best Deal
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <!-- More Hotels can be added here -->
                        </div>

                        <!-- Sidebar - Contact Form -->
                        <div class="lg:col-span-1">
                            <div class="bg-white rounded-xl shadow-md p-6 border border-gray-200 sticky top-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-4">Get the List of Top Hotels</h3>
                                <p class="text-gray-600 mb-6">We'll send you contact details in seconds for free</p>

                                <!-- Hotel Type Selection -->
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">
                                        What type of Hotel are you looking for?
                                    </label>
                                    <div class="flex flex-wrap gap-2">
                                        <button
                                            class="bg-blue-100 text-blue-700 border-2 border-blue-200 px-4 py-2 rounded-lg font-medium">
                                            Budget
                                        </button>
                                        <button
                                            class="bg-gray-100 text-gray-700 border-2 border-gray-200 px-4 py-2 rounded-lg font-medium hover:bg-gray-200">
                                            Luxury
                                        </button>
                                        <button
                                            class="bg-gray-100 text-gray-700 border-2 border-gray-200 px-4 py-2 rounded-lg font-medium hover:bg-gray-200">
                                            Others
                                        </button>
                                    </div>
                                </div>

                                <!-- Contact Form -->
                                <form class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                                        <input type="text"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Enter your name">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Mobile Number</label>
                                        <input type="tel"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Enter your mobile number">
                                    </div>

                                    <!-- Terms & Privacy -->
                                    <div class="flex items-start mb-4">
                                        <input type="checkbox" id="terms"
                                            class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mt-1">
                                        <label for="terms" class="ml-2 text-sm text-gray-600">
                                            I Agree to
                                            <a href="#" class="text-blue-600 hover:underline">T&C's</a>
                                            and
                                            <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a>.
                                        </label>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="button" onclick="submitHotelRequest()"
                                        class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold py-3.5 px-6 rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                                        Get Best Deal >>
                                    </button>
                                </form>

                                <!-- Additional Info -->
                                <div class="mt-6 pt-6 border-t border-gray-200">
                                    <div class="space-y-3">
                                        <div class="flex items-center text-sm text-gray-600">
                                            <i class="fas fa-shield-alt text-green-500 mr-2"></i>
                                            <span>Verified hotel listings only</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-600">
                                            <i class="fas fa-clock text-blue-500 mr-2"></i>
                                            <span>Instant response guaranteed</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-600">
                                            <i class="fas fa-handshake text-purple-500 mr-2"></i>
                                            <span>No commission or hidden charges</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Tab -->
        <div id="profile" class="tab-content hidden">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
                    <div class="bg-gradient-to-r from-teal-600 to-cyan-500 h-32"></div>

                    <div class="px-8 pb-8 relative">
                        <div class="relative -top-12">
                            <div
                                class="w-24 h-24 bg-white rounded-full border-4 border-white shadow-lg mx-auto mb-4 flex items-center justify-center">
                                <i class="fas fa-user text-teal-600 text-4xl"></i>
                            </div>

                            <div class="text-center mb-6">
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">Your Profile</h3>
                                <p class="text-gray-600 mb-4">Complete your profile to get the most out of GBS Network</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h4 class="font-bold text-gray-800 mb-4 flex items-center">
                                    <i class="fas fa-user-circle text-teal-600 mr-2"></i> Profile Status
                                </h4>
                                <div class="space-y-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-gray-600">Profile Completion</span>
                                        <span class="font-bold text-teal-600">65%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-teal-500 h-2 rounded-full" style="width: 65%"></div>
                                    </div>
                                    <p class="text-sm text-gray-500 mt-4">Complete your profile to increase visibility by
                                        300%</p>
                                </div>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-6">
                                <h4 class="font-bold text-gray-800 mb-4 flex items-center">
                                    <i class="fas fa-chart-line text-teal-600 mr-2"></i> Network Stats
                                </h4>
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-teal-600">42</div>
                                        <div class="text-sm text-gray-600">Connections</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-teal-600">12</div>
                                        <div class="text-sm text-gray-600">Posts</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-teal-600">8</div>
                                        <div class="text-sm text-gray-600">Resources</div>
                                    </div>
                                    <div class="text-center">
                                        <div class="text-2xl font-bold text-teal-600">245</div>
                                        <div class="text-sm text-gray-600">Profile Views</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('login') }}"
                                class="bg-teal-600 text-white px-8 py-3 rounded-lg font-medium hover:bg-teal-700 text-center">
                                <i class="fas fa-sign-in-alt mr-2"></i>Login to Continue
                            </a>
                            <a href="{{ route('register') }}"
                                class="border-2 border-teal-600 text-teal-600 px-8 py-3 rounded-lg font-medium hover:bg-teal-50 text-center">
                                <i class="fas fa-user-plus mr-2"></i>Create Account
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    // Country, State, District API
    const countrySelect = document.getElementById("country");
    const stateSelect = document.getElementById("state");
    const districtSelect = document.getElementById("district");

    // Set default values from old input
    @if(old('country'))
        setTimeout(() => {
            countrySelect.value = "{{ old('country') }}";
            loadStates("{{ old('country') }}");
            
            @if(old('state'))
                setTimeout(() => {
                    stateSelect.value = "{{ old('state') }}";
                    loadDistricts("{{ old('country') }}", "{{ old('state') }}");
                    
                    @if(old('district'))
                        setTimeout(() => {
                            districtSelect.value = "{{ old('district') }}";
                        }, 500);
                    @endif
                }, 500);
            @endif
        }, 500);
    @endif

    // Load all countries
    async function loadCountries() {
        const res = await fetch("https://countriesnow.space/api/v0.1/countries/positions");
        const result = await res.json();

        countrySelect.innerHTML = `<option value="">Select Country</option>`;

        result.data.forEach(item => {
            countrySelect.innerHTML += `<option value="${item.name}">${item.name}</option>`;
        });

        // Default select India if no old value
        @if(!old('country'))
            countrySelect.value = "India";
            loadStates("India");
        @endif
    }

    // Load states of selected country
    async function loadStates(country) {
        const res = await fetch("https://countriesnow.space/api/v0.1/countries/states", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ country })
        });

        const result = await res.json();

        stateSelect.innerHTML = `<option value="">Select State</option>`;
        districtSelect.innerHTML = `<option value="">Select District</option>`; 

        if (!result.data || !result.data.states) return;

        result.data.states.forEach(state => {
            stateSelect.innerHTML += `<option value="${state.name}">${state.name}</option>`;
        });
    }

    // Load districts/cities of selected state
    async function loadDistricts(country, state) {
        const res = await fetch("https://countriesnow.space/api/v0.1/countries/state/cities", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ country, state })
        });

        const result = await res.json();

        districtSelect.innerHTML = `<option value="">Select District</option>`;

        if (!result.data) return;

        result.data.forEach(city => {
            districtSelect.innerHTML += `<option value="${city}">${city}</option>`;
        });
    }

    // On change events
    countrySelect.addEventListener("change", function () {
        loadStates(this.value);
    });

    stateSelect.addEventListener("change", function () {
        if (countrySelect.value && this.value) {
            loadDistricts(countrySelect.value, this.value);
        }
    });

    // Auto-run
    loadCountries();

    // Circles and Sub-Circles dynamic loading
    const circleSelect = document.getElementById('circle_id');
    const subCircleSection = document.getElementById('subCircleSection');
    const subCircleSelect = document.getElementById('sub_circle_id');

    // Load sub-circles when circle is selected
    circleSelect.addEventListener('change', function() {
        const circleId = this.value;
        
        if (circleId) {
            // Fetch sub-circles from API
            fetch(`/api/circles/${circleId}/sub-circles`)
                .then(response => response.json())
                .then(data => {
                    subCircleSelect.innerHTML = '<option value="">Select Sub-Circle</option>';
                    
                    if (data.length > 0) {
                        data.forEach(subCircle => {
                            subCircleSelect.innerHTML += `<option value="${subCircle.id}">${subCircle.subcircle}</option>`;
                        });
                        subCircleSection.classList.remove('hidden');
                    } else {
                        subCircleSection.classList.add('hidden');
                    }
                    
                    // Set old value if exists
                    @if(old('sub_circle_id'))
                        setTimeout(() => {
                            subCircleSelect.value = "{{ old('sub_circle_id') }}";
                        }, 100);
                    @endif
                })
                .catch(error => {
                    console.error('Error loading sub-circles:', error);
                });
        } else {
            subCircleSection.classList.add('hidden');
            subCircleSelect.innerHTML = '<option value="">Select Sub-Circle</option>';
        }
    });

    // Load sub-circles on page load if circle is already selected
    @if(old('circle_id'))
        document.addEventListener('DOMContentLoaded', function() {
            circleSelect.value = "{{ old('circle_id') }}";
            circleSelect.dispatchEvent(new Event('change'));
        });
    @endif

    // Checkbox styling
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const label = this.closest('label');
            if (this.checked) {
                label.classList.add('bg-blue-50', 'border-blue-500', 'text-blue-700');
                label.classList.remove('border-gray-300');
            } else {
                label.classList.remove('bg-blue-50', 'border-blue-500', 'text-blue-700');
                label.classList.add('border-gray-300');
            }
        });

        // Set initial styling for old values
        if (checkbox.checked) {
            const label = checkbox.closest('label');
            label.classList.add('bg-blue-50', 'border-blue-500', 'text-blue-700');
            label.classList.remove('border-gray-300');
        }
    });
</script>
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
                activeButton.classList.add('active', 'border-b-2', 'border-teal-600', 'text-teal-600', 'bg-teal-50');
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
        });

        // Resource filtering
        function filterResources(type) {
            const resources = document.querySelectorAll('.resource-card');
            const buttons = document.querySelectorAll('#resources .flex-wrap button');

            // Update button styles
            buttons.forEach(button => {
                if (button.textContent.toLowerCase().includes(type) ||
                    (type === 'all' && button.textContent.includes('All Resources'))) {
                    button.classList.remove('bg-gray-100', 'text-gray-700');
                    button.classList.add('bg-blue-600', 'text-white');
                } else {
                    button.classList.remove('bg-blue-600', 'text-white');
                    button.classList.add('bg-gray-100', 'text-gray-700');
                }
            });

            // Show/hide resources
            resources.forEach(resource => {
                if (type === 'all') {
                    resource.style.display = 'block';
                } else {
                    if (resource.getAttribute('data-type') === type) {
                        resource.style.display = 'block';
                    } else {
                        resource.style.display = 'none';
                    }
                }
            });
        }

        // Media playback functions
        function playDummyAudio(audioId) {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4';
            modal.innerHTML = `
                <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Now Playing</h3>
                        <button onclick="this.closest('.fixed').remove()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <div class="text-center mb-6">
                        <div class="w-24 h-24 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-music text-white text-3xl"></i>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-2">Leadership Podcast</h4>
                        <p class="text-gray-600">Episode 3: Team Management</p>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>2:45</span>
                            <div class="flex-1 mx-4">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-purple-600 h-2 rounded-full" style="width: 45%"></div>
                                </div>
                            </div>
                            <span>25:18</span>
                        </div>
                        <div class="flex items-center justify-center space-x-8">
                            <button class="text-gray-500 hover:text-purple-600 text-2xl">
                                <i class="fas fa-step-backward"></i>
                            </button>
                            <button class="w-14 h-14 bg-purple-600 text-white rounded-full flex items-center justify-center hover:bg-purple-700">
                                <i class="fas fa-play text-xl"></i>
                            </button>
                            <button class="text-gray-500 hover:text-purple-600 text-2xl">
                                <i class="fas fa-step-forward"></i>
                            </button>
                        </div>
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <button class="hover:text-purple-600">
                                <i class="fas fa-volume-up mr-1"></i> Volume
                            </button>
                            <button class="hover:text-purple-600">
                                <i class="fas fa-redo mr-1"></i> Repeat
                            </button>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            showNotification("Audio playback started");
        }

        function playDummyVideo(videoId) {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black flex items-center justify-center z-50';
            modal.innerHTML = `
                <div class="relative w-full max-w-4xl mx-4">
                    <button onclick="this.closest('.fixed').remove()" 
                            class="absolute -top-12 right-0 text-white hover:text-gray-300 z-10">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                    <div class="bg-black rounded-xl overflow-hidden">
                        <div class="relative pt-[56.25%]">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center">
                                    <div class="w-20 h-20 bg-white bg-opacity-90 rounded-full flex items-center justify-center mb-4 mx-auto">
                                        <i class="fas fa-play text-blue-600 text-3xl"></i>
                                    </div>
                                    <p class="text-white font-medium">Video Player (Demo)</p>
                                    <p class="text-gray-300 text-sm mt-2">This would play the video in a real application</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 bg-gray-900">
                            <h4 class="text-white font-bold text-lg mb-2">Digital Marketing Masterclass</h4>
                            <p class="text-gray-300 text-sm">Lesson 5: Social Media Strategy</p>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            showNotification("Video playback started");
        }

        function viewDummyPDF(pdfId) {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4';
            modal.innerHTML = `
                <div class="bg-white rounded-xl shadow-xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
                    <div class="flex justify-between items-center p-6 border-b border-gray-200">
                        <h3 class="text-xl font-bold text-gray-800">PDF Viewer (Demo)</h3>
                        <div class="flex items-center space-x-4">
                            <button class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-download"></i>
                            </button>
                            <button onclick="this.closest('.fixed').remove()" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-6 overflow-auto max-h-[70vh]">
                        <div class="bg-gray-100 rounded-lg p-8 text-center">
                            <div class="w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-file-pdf text-red-600 text-4xl"></i>
                            </div>
                            <h4 class="text-xl font-bold text-gray-800 mb-2">Business Plan Template 2024.pdf</h4>
                            <p class="text-gray-600 mb-6">15 pages • 2.4 MB • PDF Document</p>
                            <div class="max-w-md mx-auto text-left space-y-3">
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span>Editable templates included</span>
                                </div>
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span>Financial projections sheets</span>
                                </div>
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span>Market analysis framework</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 border-t border-gray-200">
                        <button onclick="this.closest('.fixed').remove()" 
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium">
                            <i class="fas fa-download mr-2"></i> Download PDF (Demo)
                        </button>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            showNotification("PDF viewer opened");
        }

        function viewDummyImages() {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4';
            modal.innerHTML = `
                <div class="bg-white rounded-xl shadow-xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
                    <div class="flex justify-between items-center p-6 border-b border-gray-200">
                        <h3 class="text-xl font-bold text-gray-800">Image Gallery (Demo)</h3>
                        <button onclick="this.closest('.fixed').remove()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <div class="p-6 overflow-auto max-h-[70vh]">
                        <div class="grid grid-cols-3 gap-4">
                            ${Array.from({length: 9}, (_, i) => ` <
                div class = "relative group" >
                <
                img src =
                "https://images.unsplash.com/photo-${1551288049 + i}?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
            alt = "Image ${i+1}"
            class = "w-full h-40 object-cover rounded-lg" >
            <
            div class =
            "absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 rounded-lg flex items-center justify-center opacity-0 group-hover:opacity-100" >
            <
            button class = "bg-white text-gray-800 px-4 py-2 rounded-lg font-medium" >
            <
            i class = "fas fa-download mr-1" > < /i> Download < /
            button > <
                /div> < /
                div >
                `).join('')}
                        </div>
                    </div>
                    <div class="p-6 border-t border-gray-200 text-center">
                        <p class="text-gray-600">150+ professional images available for download</p>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            showNotification("Image gallery opened");
        }
    </script>
    <script>
        let selectedFile = null;
        let currentFileType = null;

        function openFilePicker(type) {
            currentFileType = type;

            switch (type) {
                case 'image':
                    document.getElementById('imageInput').click();
                    break;
                case 'video':
                    document.getElementById('videoInput').click();
                    break;
                case 'audio':
                    document.getElementById('fileInput').click();
                    break;
                case 'document':
                    document.getElementById('fileInput').click();
                    break;
            }
        }

        // Image input change handler
        document.getElementById('imageInput').addEventListener('change', function(e) {
            handleFileSelect(e, 'image');
        });

        // Video input change handler
        document.getElementById('videoInput').addEventListener('change', function(e) {
            handleFileSelect(e, 'video');
        });

        // Document input change handler
        document.getElementById('fileInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            // Determine file type
            const fileName = file.name.toLowerCase();
            let type = 'document';

            if (fileName.endsWith('.mp3') || fileName.endsWith('.wav') || fileName.endsWith('.m4a')) {
                type = 'audio';
            } else if (fileName.endsWith('.pdf')) {
                type = 'pdf';
            }

            handleFileSelect(e, type);
        });

        function handleFileSelect(event, type) {
            const file = event.target.files[0];
            if (!file) return;

            selectedFile = {
                name: file.name,
                type: type,
                size: (file.size / (1024 * 1024)).toFixed(2) + ' MB'
            };

            showPreview(selectedFile);
        }

        function showPreview(file) {
            const previewSection = document.getElementById('previewSection');
            const mediaPreview = document.getElementById('mediaPreview');

            previewSection.classList.remove('hidden');

            if (file.type === 'image') {
                mediaPreview.innerHTML = `
            <div class="flex items-center space-x-3 p-2 bg-gray-50 rounded-lg">
                <div class="w-16 h-16 flex-shrink-0">
                    <div class="w-full h-full bg-gradient-to-br from-green-100 to-blue-100 rounded flex items-center justify-center">
                        <i class="fas fa-image text-green-500 text-xl"></i>
                    </div>
                </div>
                <div>
                    <p class="font-medium text-gray-800">${file.name}</p>
                    <p class="text-sm text-gray-500">Image • ${file.size}</p>
                </div>
            </div>
        `;
            } else if (file.type === 'video') {
                mediaPreview.innerHTML = `
            <div class="flex items-center space-x-3 p-2 bg-gray-50 rounded-lg">
                <div class="w-16 h-16 flex-shrink-0 bg-red-100 rounded flex items-center justify-center">
                    <i class="fas fa-video text-red-600 text-2xl"></i>
                </div>
                <div>
                    <p class="font-medium text-gray-800">${file.name}</p>
                    <p class="text-sm text-gray-500">Video • ${file.size}</p>
                </div>
            </div>
        `;
            } else if (file.type === 'audio') {
                mediaPreview.innerHTML = `
            <div class="flex items-center space-x-3 p-2 bg-gray-50 rounded-lg">
                <div class="w-16 h-16 flex-shrink-0 bg-purple-100 rounded flex items-center justify-center">
                    <i class="fas fa-music text-purple-600 text-2xl"></i>
                </div>
                <div>
                    <p class="font-medium text-gray-800">${file.name}</p>
                    <p class="text-sm text-gray-500">Audio • ${file.size}</p>
                </div>
            </div>
        `;
            } else if (file.type === 'pdf') {
                mediaPreview.innerHTML = `
            <div class="flex items-center space-x-3 p-2 bg-gray-50 rounded-lg">
                <div class="w-16 h-16 flex-shrink-0 bg-red-100 rounded flex items-center justify-center">
                    <i class="fas fa-file-pdf text-red-600 text-2xl"></i>
                </div>
                <div>
                    <p class="font-medium text-gray-800">${file.name}</p>
                    <p class="text-sm text-gray-500">PDF • ${file.size}</p>
                </div>
            </div>
        `;
            } else {
                mediaPreview.innerHTML = `
            <div class="flex items-center space-x-3 p-2 bg-gray-50 rounded-lg">
                <div class="w-16 h-16 flex-shrink-0 bg-blue-100 rounded flex items-center justify-center">
                    <i class="fas fa-file text-blue-600 text-2xl"></i>
                </div>
                <div>
                    <p class="font-medium text-gray-800">${file.name}</p>
                    <p class="text-sm text-gray-500">Document • ${file.size}</p>
                </div>
            </div>
        `;
            }
        }

        // Remove media button handler
        document.getElementById('removeMediaBtn').addEventListener('click', function() {
            selectedFile = null;
            currentFileType = null;

            document.getElementById('imageInput').value = '';
            document.getElementById('videoInput').value = '';
            document.getElementById('fileInput').value = '';

            document.getElementById('mediaPreview').innerHTML = '';
            document.getElementById('previewSection').classList.add('hidden');
        });

        function createDummyPost() {
            const content = document.getElementById('postContent').value.trim();

            if (!content && !selectedFile) {
                alert('Please add some content or a file to post.');
                return;
            }

            // Show dummy success message
            const messages = [
                "Your post has been shared successfully!",
                "Post created! It's now visible to your network.",
                "Success! Your update has been posted.",
                "Posted! Your content is now live."
            ];

            const randomMessage = messages[Math.floor(Math.random() * messages.length)];
            showNotification(randomMessage);

            // Reset form
            document.getElementById('postContent').value = '';
            if (selectedFile) {
                selectedFile = null;
                document.getElementById('imageInput').value = '';
                document.getElementById('videoInput').value = '';
                document.getElementById('fileInput').value = '';
                document.getElementById('mediaPreview').innerHTML = '';
                document.getElementById('previewSection').classList.add('hidden');
            }
        }

        function showDummyEvent() {
            const eventModal = document.createElement('div');
            eventModal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4';
            eventModal.innerHTML = `
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Create Event (Demo)</h3>
                <button onclick="this.closest('.fixed').remove()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="space-y-4">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                        <p class="text-blue-700 text-sm">This is a demo. In a real application, you would see a full event creation form here.</p>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Event Title</label>
                    <input type="text" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Team Meeting" value="Team Meeting">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                    <input type="text" class="w-full p-2 border border-gray-300 rounded-lg" value="Tomorrow, 2:00 PM">
                </div>
                <div class="pt-4 flex justify-end space-x-3">
                    <button onclick="this.closest('.fixed').remove()" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                        Cancel
                    </button>
                    <button onclick="createDummyEvent(this)" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg">
                        Create Event
                    </button>
                </div>
            </div>
        </div>
    `;
            document.body.appendChild(eventModal);
        }

        function createDummyEvent(button) {
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating...';

            setTimeout(() => {
                showNotification("Event created successfully! (Demo)");
                document.querySelector('.fixed').remove();
            }, 1500);
        }

        function showNotification(message) {
            // Create notification element
            const notification = document.createElement('div');
            notification.className =
                'fixed top-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-slide-in';
            notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-3"></i>
            <span>${message}</span>
        </div>
    `;

            document.body.appendChild(notification);

            // Remove after 3 seconds
            setTimeout(() => {
                notification.classList.add('animate-fade-out');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }

        function submitHotelRequest() {
            const name = document.querySelector('#directory input[type="text"]').value;
            const mobile = document.querySelector('#directory input[type="tel"]').value;
            const terms = document.getElementById('terms').checked;

            if (!name || !mobile) {
                alert('Please fill in all required fields.');
                return;
            }

            if (!terms) {
                alert('Please agree to the terms and conditions.');
                return;
            }

            // Show success message
            const button = document.querySelector('#directory button[onclick="submitHotelRequest()"]');
            const originalText = button.innerHTML;

            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
            button.disabled = true;

            setTimeout(() => {
                // Create success modal
                const modal = document.createElement('div');
                modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4';
                modal.innerHTML = `
                    <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6">
                        <div class="flex flex-col items-center text-center">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-check text-green-600 text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Request Submitted Successfully!</h3>
                            <p class="text-gray-600 mb-4">
                                We have received your request. Our team will contact you shortly with the best hotel deals.
                            </p>
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4 w-full">
                                <p class="text-sm text-blue-700">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    You will receive a confirmation SMS on ${mobile} within 5 minutes.
                                </p>
                            </div>
                            <button onclick="this.closest('.fixed').remove()" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-6 rounded-lg">
                                Close
                            </button>
                        </div>
                    </div>
                `;

                document.body.appendChild(modal);

                // Reset button
                button.innerHTML = originalText;
                button.disabled = false;

                // Reset form
                document.querySelector('#directory input[type="text"]').value = '';
                document.querySelector('#directory input[type="tel"]').value = '';
                document.getElementById('terms').checked = false;

            }, 1500);
        }

        // Add CSS animations
        const style = document.createElement('style');
        style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes fadeOut {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
        }
    }
    
    .animate-slide-in {
        animation: slideIn 0.3s ease-out forwards;
    }
    
    .animate-fade-out {
        animation: fadeOut 0.3s ease-out forwards;
    }

    .resource-card {
        transition: all 0.3s ease;
    }

    .resource-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
`;
        document.head.appendChild(style);

        function toggleMobileFilters() {
            const mobileFilters = document.getElementById('mobileFilters');
            const button = document.querySelector('[onclick="toggleMobileFilters()"]');

            if (mobileFilters.classList.contains('hidden')) {
                mobileFilters.classList.remove('hidden');
                button.innerHTML = `
            <i class="fas fa-filter"></i>
            <span>Show Less Filters</span>
            <i class="fas fa-chevron-up text-sm"></i>
        `;
            } else {
                mobileFilters.classList.add('hidden');
                button.innerHTML = `
            <i class="fas fa-filter"></i>
            <span>Show More Filters</span>
            <i class="fas fa-chevron-down text-sm"></i>
        `;
            }
        }
    </script>

    <style>
        .tab-button.active {
            position: relative;
        }

        .tab-button.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(to right, #0d9488, #0891b2);
            border-radius: 3px 3px 0 0;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .hover-lift:hover {
            transform: translateY(-4px);
            transition: transform 0.3s ease;
        }
    </style>
@endsection
