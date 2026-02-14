 <div class="max-w-7xl mx-auto">

     <!-- Step 1: Circles Grid (Initially Visible) -->
     <div id="circlesGrid" class="mb-8">
         <h2 class="text-3xl font-bold text-gray-800 mb-2 text-center">Browse Circles</h2>
         <p class="text-gray-600 text-center mb-8">Select a professional circle to explore resources</p>

         <!-- Responsive Grid: 1 column on mobile, 4 columns on desktop -->
         <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
             @forelse($circles as $circle)
                 <!-- Dynamic Category Card -->
                 <div onclick="selectCircle({{ $circle->id }}, '{{ $circle->title }}')"
                     class="category-card bg-white rounded-xl shadow-md p-6 text-center cursor-pointer hover:shadow-lg transition-all duration-300 border-2 border-transparent hover:border-teal-500">
                     <!-- Icon Container -->
                     <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center"
                         style="background-color: {{ $circle->color ? $circle->color . '20' : '#EFF6FF' }}">
                         @if ($circle->icon)
                             @if (str_contains($circle->icon, 'fa-'))
                                 <i class="{{ $circle->icon }} text-2xl"
                                     style="color: {{ $circle->color ? $circle->color : '#3B82F6' }}"></i>
                             @elseif(filter_var($circle->icon, FILTER_VALIDATE_URL))
                                 <img src="{{ $circle->icon }}" alt="{{ $circle->title }}" class="w-8 h-8">
                             @endif
                         @else
                             @php
                                 $fallbackIcon = 'fas fa-users';
                                 $fallbackColor = '#6B7280';

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
                                     'education' => [
                                         'icon' => 'fas fa-graduation-cap',
                                         'color' => '#EC4899',
                                     ],
                                     'teacher' => ['icon' => 'fas fa-graduation-cap', 'color' => '#EC4899'],
                                 ];

                                 $titleLower = strtolower($circle->title);
                                 foreach ($iconMap as $key => $value) {
                                     if (str_contains($titleLower, $key)) {
                                         $fallbackIcon = $value['icon'];
                                         $fallbackColor = $value['color'];
                                         break;
                                     }
                                 }
                             @endphp

                             <i class="{{ $fallbackIcon }} text-2xl" style="color: {{ $fallbackColor }}"></i>
                         @endif
                     </div>

                     <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $circle->title }}</h3>
                     <p class="text-gray-600 text-sm mb-4">
                         {{ $circle->description ?? 'Professional network and resources' }}</p>
                     <div class="font-medium flex items-center justify-center gap-2 text-teal-600">
                         <span>Select Circle</span>
                         <i class="fas fa-arrow-right text-sm"></i>
                     </div>
                 </div>
             @empty
                 <div class="col-span-1 lg:col-span-4 text-center py-8">
                     <p class="text-gray-500 text-lg">No circles available at the moment.</p>
                 </div>
             @endforelse
         </div>
     </div>

     <!-- Step 2: Sub-Circles Grid (Hidden by Default) -->
     <div id="subCirclesContainer" class="hidden mb-8">
         <!-- Back Button and Header -->
         <div class="flex items-center justify-between mb-6">
             <button onclick="backToCircles()"
                 class="flex items-center gap-2 px-4 py-2 text-gray-600 hover:text-gray-800 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                 <i class="fas fa-arrow-left"></i>
                 <span>Back to Circles</span>
             </button>
             <h3 id="selectedCircleTitle" class="text-2xl font-bold text-gray-800"></h3>
             <div class="w-24"></div> <!-- Spacer for alignment -->
         </div>

         <!-- Sub-Circles Grid -->
         <div id="subCirclesGrid" class="grid grid-cols-1 lg:grid-cols-3 gap-6">
             <!-- Sub-circles will be loaded dynamically via JavaScript -->
         </div>
     </div>

     <!-- Step 3: Resources Section (Hidden by Default) -->
     <div id="resourcesContainer" class="hidden">
         <!-- Back Button and Header -->
         <div class="flex items-center justify-between mb-6">
             <button onclick="backToSubCircles()"
                 class="flex items-center gap-2 px-4 py-2 text-gray-600 hover:text-gray-800 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                 <i class="fas fa-arrow-left"></i>
                 <span>Back to Sub-Circles</span>
             </button>
             <div>
                 <h3 id="selectedSubCircleTitle" class="text-2xl font-bold text-gray-800"></h3>
                 <p id="selectedCircleContext" class="text-sm text-gray-500 text-center"></p>
             </div>
             <div class="w-24"></div> <!-- Spacer for alignment -->
         </div>

         <!-- Resource Categories Filter -->
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
                             <span class="text-sm font-medium text-gray-700">Episode 1: Visionary
                                 Leadership</span>
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
 <script>
     // Global variables to track current selections
     let currentCircleId = null;
     let currentCircleTitle = '';
     let currentSubCircleId = null;
     let currentSubCircleTitle = '';

     // Function to select a circle and load its sub-circles
     async function selectCircle(circleId, circleTitle) {
         currentCircleId = circleId;
         currentCircleTitle = circleTitle;

         // Update UI
         document.getElementById('circlesGrid').classList.add('hidden');
         document.getElementById('subCirclesContainer').classList.remove('hidden');
         document.getElementById('resourcesContainer').classList.add('hidden');

         document.getElementById('selectedCircleTitle').textContent = circleTitle;

         // Load sub-circles
         await loadSubCircles(circleId);
     }

     // Function to load sub-circles for a circle
     async function loadSubCircles(circleId) {
         const subCirclesGrid = document.getElementById('subCirclesGrid');
         subCirclesGrid.innerHTML = `
            <div class="col-span-1 lg:col-span-3 text-center py-8">
                <div class="flex justify-center">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-teal-600"></div>
                </div>
                <p class="text-gray-500 mt-4">Loading sub-circles...</p>
            </div>
        `;

         try {
             const response = await fetch(`/api/circles/${circleId}/sub-circles`);
             const data = await response.json();

             if (data.length > 0) {
                 displaySubCircles(data);
             } else {
                 subCirclesGrid.innerHTML = `
                    <div class="col-span-1 lg:col-span-3 text-center py-12 bg-gray-50 rounded-xl">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-folder-open text-gray-400 text-3xl"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-800 mb-2">No Sub-Circles Yet</h4>
                        <p class="text-gray-500 mb-6">This circle doesn't have any sub-circles yet.</p>
                        <button onclick="proceedToResources(null, '${currentCircleTitle} - General')" 
                                class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                            <i class="fas fa-arrow-right mr-2"></i>View Circle Resources
                        </button>
                    </div>
                `;
             }
         } catch (error) {
             console.error('Error loading sub-circles:', error);
             subCirclesGrid.innerHTML = `
                <div class="col-span-1 lg:col-span-3 text-center py-12 bg-red-50 rounded-xl">
                    <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-exclamation-triangle text-red-500 text-3xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Error Loading Sub-Circles</h4>
                    <p class="text-gray-500 mb-6">There was a problem loading the sub-circles.</p>
                    <button onclick="backToCircles()" 
                            class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Circles
                    </button>
                </div>
            `;
         }
     }

     // Function to display sub-circles in the grid
     function displaySubCircles(subCircles) {
         const subCirclesGrid = document.getElementById('subCirclesGrid');
         subCirclesGrid.innerHTML = '';

         subCircles.forEach(subCircle => {
             const card = document.createElement('div');
             card.className =
                 'bg-white rounded-xl shadow-md p-6 text-center cursor-pointer hover:shadow-lg transition-all duration-300 border-2 border-transparent hover:border-teal-500';
             card.onclick = () => selectSubCircle(subCircle.id, subCircle.subcircle);

             card.innerHTML = `
                <div class="w-16 h-16 bg-gradient-to-br from-teal-100 to-cyan-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-teal-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">${subCircle.subcircle}</h3>
                <p class="text-gray-600 text-sm mb-4">Professional resources and discussions</p>
                <div class="font-medium flex items-center justify-center gap-2 text-teal-600">
                    <span>View Resources</span>
                    <i class="fas fa-arrow-right text-sm"></i>
                </div>
            `;

             subCirclesGrid.appendChild(card);
         });
     }

     // Function to select a sub-circle and show resources
     function selectSubCircle(subCircleId, subCircleTitle) {
         currentSubCircleId = subCircleId;
         currentSubCircleTitle = subCircleTitle;

         // Update UI
         document.getElementById('subCirclesContainer').classList.add('hidden');
         document.getElementById('resourcesContainer').classList.remove('hidden');

         document.getElementById('selectedSubCircleTitle').textContent = subCircleTitle;
         document.getElementById('selectedCircleContext').textContent = `${currentCircleTitle} Circle`;
     }

     // Function to proceed directly to resources (when no sub-circles)
     function proceedToResources(subCircleId, title) {
         if (subCircleId) {
             currentSubCircleId = subCircleId;
             currentSubCircleTitle = title;
         } else {
             currentSubCircleId = null;
             currentSubCircleTitle = title;
         }

         document.getElementById('subCirclesContainer').classList.add('hidden');
         document.getElementById('resourcesContainer').classList.remove('hidden');

         document.getElementById('selectedSubCircleTitle').textContent = title;
         document.getElementById('selectedCircleContext').textContent = `${currentCircleTitle} Circle`;
     }

     // Function to go back from sub-circles to circles
     function backToCircles() {
         document.getElementById('circlesGrid').classList.remove('hidden');
         document.getElementById('subCirclesContainer').classList.add('hidden');
         document.getElementById('resourcesContainer').classList.add('hidden');

         // Clear selections
         currentCircleId = null;
         currentCircleTitle = '';
         currentSubCircleId = null;
         currentSubCircleTitle = '';
     }

     // Function to go back from resources to sub-circles
     function backToSubCircles() {
         document.getElementById('subCirclesContainer').classList.remove('hidden');
         document.getElementById('resourcesContainer').classList.add('hidden');

         // Clear sub-circle selection
         currentSubCircleId = null;
         currentSubCircleTitle = '';
     }

     // Resource filtering function (existing)
     function filterResources(type) {
         const resources = document.querySelectorAll('#resourcesGrid .resource-card');
         const buttons = document.querySelectorAll('#resourcesContainer .flex-wrap button');

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

     // Media playback functions (keep your existing implementations)
     function playDummyAudio(audioId) {
         // Your existing playDummyAudio implementation
         showNotification("Audio playback started (Demo)");
     }

     function playDummyVideo(videoId) {
         // Your existing playDummyVideo implementation
         showNotification("Video playback started (Demo)");
     }

     function viewDummyPDF(pdfId) {
         // Your existing viewDummyPDF implementation
         showNotification("PDF viewer opened (Demo)");
     }

     function viewDummyImages() {
         // Your existing viewDummyImages implementation
         showNotification("Image gallery opened (Demo)");
     }

     // Reset resources view when switching tabs
     function switchTab(tabName) {
         // ... your existing switchTab code ...

         if (tabName === 'resources') {
             // Reset to circles view when switching to resources tab
             backToCircles();
         }
     }

     // Modify your existing switchTab function to include the reset
     const originalSwitchTab = switchTab;
     window.switchTab = function(tabName) {
         // Call the original function
         originalSwitchTab(tabName);

         // Additional logic for resources tab
         if (tabName === 'resources') {
             backToCircles();
         }
     };
 </script>
