<div class="max-w-7xl mx-auto">
    <!-- Step 1: Circles Grid -->
    <div id="circlesGrid" class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-2 text-center">Browse Circles</h2>
        <p class="text-gray-600 text-center mb-8">Select a professional circle to explore resources</p>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            @forelse($circles as $circle)
                <div onclick="selectCircle({{ $circle->id }}, '{{ $circle->title }}')"
                     class="category-card bg-white rounded-xl shadow-md p-6 text-center cursor-pointer hover:shadow-lg transition-all duration-300 border-2 border-transparent hover:border-teal-500">
                    <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center"
                         style="background-color: {{ $circle->color ? $circle->color . '20' : '#EFF6FF' }}">
                        @if ($circle->icon)
                            @if (str_contains($circle->icon, 'fa-'))
                                <i class="{{ $circle->icon }} text-2xl" style="color: {{ $circle->color ? $circle->color : '#3B82F6' }}"></i>
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
                                    'education' => ['icon' => 'fas fa-graduation-cap', 'color' => '#EC4899'],
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
                    <p class="text-gray-600 text-sm mb-4">{{ $circle->description ?? 'Professional network and resources' }}</p>
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

    <!-- Step 2: Sub-Circles Grid -->
    <div id="subCirclesContainer" class="hidden mb-8">
        <div class="flex items-center justify-between mb-6">
            <button onclick="backToCircles()"
                class="flex items-center gap-2 px-4 py-2 text-gray-600 hover:text-gray-800 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Circles</span>
            </button>
            <h3 id="selectedCircleTitle" class="text-2xl font-bold text-gray-800"></h3>
            <div class="w-24"></div>
        </div>
        <div id="subCirclesGrid" class="grid grid-cols-1 lg:grid-cols-3 gap-6"></div>
    </div>

    <!-- Step 3: Categories Grid (NEW) -->
    <div id="categoriesContainer" class="hidden mb-8">
        <div class="flex items-center justify-between mb-6">
            <button onclick="backToSubCircles()"
                class="flex items-center gap-2 px-4 py-2 text-gray-600 hover:text-gray-800 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Sub-Circles</span>
            </button>
            <div>
                <h3 id="selectedSubCircleTitle" class="text-2xl font-bold text-gray-800"></h3>
                <p id="selectedCircleContext2" class="text-sm text-gray-500 text-center"></p>
            </div>
            <div class="w-24"></div>
        </div>
        <div id="categoriesGrid" class="grid grid-cols-1 lg:grid-cols-4 gap-6"></div>
    </div>

    <!-- Step 4: Resources Grid -->
    <div id="resourcesContainer" class="hidden">
        <div class="flex items-center justify-between mb-6">
            <button onclick="backToCategories()"
                class="flex items-center gap-2 px-4 py-2 text-gray-600 hover:text-gray-800 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Categories</span>
            </button>
            <div>
                <h3 id="selectedCategoryTitle" class="text-2xl font-bold text-gray-800"></h3>
                <p id="selectedSubCircleContext" class="text-sm text-gray-500 text-center"></p>
            </div>
            <div class="w-24"></div>
        </div>

        <!-- Resource Type Filters -->
        <div class="flex flex-wrap gap-2 mb-8">
            <button onclick="filterResources('all')"
                class="filter-btn px-4 py-2 bg-teal-600 text-white rounded-full text-sm font-medium transition-colors">
                All Resources
            </button>
            <button onclick="filterResources('audio')"
                class="filter-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-200 transition-colors">
                <i class="fas fa-music mr-1"></i> Audio
            </button>
            <button onclick="filterResources('video')"
                class="filter-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-200 transition-colors">
                <i class="fas fa-video mr-1"></i> Video
            </button>
            <button onclick="filterResources('pdf')"
                class="filter-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-200 transition-colors">
                <i class="fas fa-file-pdf mr-1"></i> PDF
            </button>
            <button onclick="filterResources('image')"
                class="filter-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-200 transition-colors">
                <i class="fas fa-image mr-1"></i> Images
            </button>
            <button onclick="filterResources('document')"
                class="filter-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-200 transition-colors">
                <i class="fas fa-file-alt mr-1"></i> Documents
            </button>
        </div>

        <!-- Resources Grid - Dynamic -->
        <div id="resourcesGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"></div>
        
        <!-- Loading Spinner -->
        <div id="resourcesLoading" class="hidden text-center py-12">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-teal-600"></div>
            <p class="text-gray-500 mt-4">Loading resources...</p>
        </div>
        
        <!-- No Resources Message -->
        <div id="noResourcesMessage" class="hidden text-center py-12 bg-gray-50 rounded-xl">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-folder-open text-gray-400 text-3xl"></i>
            </div>
            <h4 class="text-xl font-bold text-gray-800 mb-2">No Resources Found</h4>
            <p class="text-gray-500">No resources available in this category yet.</p>
        </div>
    </div>
</div>

<script>
    // Global variables
    let currentCircleId = null;
    let currentCircleTitle = '';
    let currentSubCircleId = null;
    let currentSubCircleTitle = '';
    let currentCategoryId = null;
    let currentCategoryTitle = '';
    let currentResources = [];
    let currentFilter = 'all';

    // ==================== CIRCLE FUNCTIONS ====================
    async function selectCircle(circleId, circleTitle) {
        console.log('Selecting circle:', circleId, circleTitle);
        currentCircleId = circleId;
        currentCircleTitle = circleTitle;

        // Update UI
        document.getElementById('circlesGrid').classList.add('hidden');
        document.getElementById('subCirclesContainer').classList.remove('hidden');
        document.getElementById('categoriesContainer').classList.add('hidden');
        document.getElementById('resourcesContainer').classList.add('hidden');

        document.getElementById('selectedCircleTitle').textContent = circleTitle;

        await loadSubCircles(circleId);
    }

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
                        <h4 class="text-xl font-bold text-gray-800 mb-2">No Sub-Circles Found</h4>
                        <p class="text-gray-500 mb-6">This circle doesn't have any sub-circles.</p>
                        <button onclick="loadCategories(null, 'General Resources')" 
                                class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                            <i class="fas fa-arrow-right mr-2"></i>View All Resources
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

    function displaySubCircles(subCircles) {
        const subCirclesGrid = document.getElementById('subCirclesGrid');
        subCirclesGrid.innerHTML = '';

        subCircles.forEach(subCircle => {
            const card = document.createElement('div');
            card.className = 'bg-white rounded-xl shadow-md p-6 text-center cursor-pointer hover:shadow-lg transition-all duration-300 border-2 border-transparent hover:border-teal-500';
            card.onclick = () => loadCategories(subCircle.id, subCircle.subcircle);

            card.innerHTML = `
                <div class="w-16 h-16 bg-gradient-to-br from-teal-100 to-cyan-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-users text-teal-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">${subCircle.subcircle}</h3>
                <p class="text-gray-600 text-sm mb-4">Professional resources and discussions</p>
                <div class="font-medium flex items-center justify-center gap-2 text-teal-600">
                    <span>View Categories</span>
                    <i class="fas fa-arrow-right text-sm"></i>
                </div>
            `;
            subCirclesGrid.appendChild(card);
        });
    }

    // ==================== CATEGORY FUNCTIONS (NEW) ====================
    async function loadCategories(subCircleId, subCircleTitle) {
        console.log('Loading categories for:', subCircleId, subCircleTitle);
        currentSubCircleId = subCircleId;
        currentSubCircleTitle = subCircleTitle;

        // Update UI
        document.getElementById('subCirclesContainer').classList.add('hidden');
        document.getElementById('categoriesContainer').classList.remove('hidden');
        document.getElementById('resourcesContainer').classList.add('hidden');

        document.getElementById('selectedSubCircleTitle').textContent = subCircleTitle;
        document.getElementById('selectedCircleContext2').textContent = `${currentCircleTitle} Circle`;

        const categoriesGrid = document.getElementById('categoriesGrid');
        categoriesGrid.innerHTML = `
            <div class="col-span-1 lg:col-span-4 text-center py-8">
                <div class="flex justify-center">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-teal-600"></div>
                </div>
                <p class="text-gray-500 mt-4">Loading categories...</p>
            </div>
        `;

        try {
            let url = subCircleId 
                ? `/api/sub-circles/${subCircleId}/categories`
                : `/api/circles/${currentCircleId}/categories`;

            const response = await fetch(url);
            const data = await response.json();

            if (data.length > 0) {
                displayCategories(data);
            } else {
                categoriesGrid.innerHTML = `
                    <div class="col-span-1 lg:col-span-4 text-center py-12 bg-gray-50 rounded-xl">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-tags text-gray-400 text-3xl"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-800 mb-2">No Categories Found</h4>
                        <p class="text-gray-500 mb-6">No categories available in this section.</p>
                        <button onclick="loadAllResources()" 
                                class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                            <i class="fas fa-arrow-right mr-2"></i>View All Resources
                        </button>
                    </div>
                `;
            }
        } catch (error) {
            console.error('Error loading categories:', error);
            categoriesGrid.innerHTML = `
                <div class="col-span-1 lg:col-span-4 text-center py-12 bg-red-50 rounded-xl">
                    <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-exclamation-triangle text-red-500 text-3xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">Error Loading Categories</h4>
                    <p class="text-gray-500 mb-6">There was a problem loading the categories.</p>
                    <button onclick="backToSubCircles()" 
                            class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Sub-Circles
                    </button>
                </div>
            `;
        }
    }

    function displayCategories(categories) {
        const categoriesGrid = document.getElementById('categoriesGrid');
        categoriesGrid.innerHTML = '';

        categories.forEach(category => {
            const card = document.createElement('div');
            card.className = 'bg-white rounded-xl shadow-md p-6 text-center cursor-pointer hover:shadow-lg transition-all duration-300 border-2 border-transparent hover:border-teal-500';
            card.onclick = () => loadResources(category.id, category.title);

            card.innerHTML = `
                <div class="w-16 h-16 bg-gradient-to-br from-purple-100 to-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-tag text-purple-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">${category.title}</h3>
                <p class="text-gray-600 text-sm mb-4">${category.description || 'Browse resources in this category'}</p>
                <div class="font-medium flex items-center justify-center gap-2 text-purple-600">
                    <span>View Resources</span>
                    <i class="fas fa-arrow-right text-sm"></i>
                </div>
            `;
            categoriesGrid.appendChild(card);
        });
    }

    // ==================== RESOURCE FUNCTIONS (DYNAMIC) ====================
    async function loadResources(categoryId, categoryTitle) {
        console.log('Loading resources for:', categoryId, categoryTitle);
        currentCategoryId = categoryId;
        currentCategoryTitle = categoryTitle;

        // Update UI
        document.getElementById('categoriesContainer').classList.add('hidden');
        document.getElementById('resourcesContainer').classList.remove('hidden');

        document.getElementById('selectedCategoryTitle').textContent = categoryTitle;
        document.getElementById('selectedSubCircleContext').textContent = `${currentSubCircleTitle || 'All'} • ${currentCircleTitle}`;

        // Show loading
        document.getElementById('resourcesLoading').classList.remove('hidden');
        document.getElementById('resourcesGrid').classList.add('hidden');
        document.getElementById('noResourcesMessage').classList.add('hidden');

        try {
            let url = `/api/resources?category_id=${categoryId}`;
            if (currentSubCircleId) {
                url += `&sub_circle_id=${currentSubCircleId}`;
            }
            url += `&circle_id=${currentCircleId}`;

            const response = await fetch(url);
            const data = await response.json();

            // Hide loading
            document.getElementById('resourcesLoading').classList.add('hidden');
            document.getElementById('resourcesGrid').classList.remove('hidden');

            if (data.length > 0) {
                currentResources = data;
                displayResources(data);
            } else {
                document.getElementById('noResourcesMessage').classList.remove('hidden');
                document.getElementById('resourcesGrid').innerHTML = '';
            }
        } catch (error) {
            console.error('Error loading resources:', error);
            document.getElementById('resourcesLoading').classList.add('hidden');
            document.getElementById('noResourcesMessage').classList.remove('hidden');
            document.getElementById('noResourcesMessage').querySelector('h4').textContent = 'Error Loading Resources';
            document.getElementById('noResourcesMessage').querySelector('p').textContent = 'Please try again later.';
        }
    }

    async function loadAllResources() {
        console.log('Loading all resources');
        document.getElementById('categoriesContainer').classList.add('hidden');
        document.getElementById('resourcesContainer').classList.remove('hidden');

        document.getElementById('selectedCategoryTitle').textContent = 'All Resources';
        document.getElementById('selectedSubCircleContext').textContent = `${currentSubCircleTitle || 'All'} • ${currentCircleTitle}`;

        // Show loading
        document.getElementById('resourcesLoading').classList.remove('hidden');
        document.getElementById('resourcesGrid').classList.add('hidden');
        document.getElementById('noResourcesMessage').classList.add('hidden');

        try {
            let url = `/api/resources?circle_id=${currentCircleId}`;
            if (currentSubCircleId) {
                url += `&sub_circle_id=${currentSubCircleId}`;
            }

            const response = await fetch(url);
            const data = await response.json();

            document.getElementById('resourcesLoading').classList.add('hidden');
            document.getElementById('resourcesGrid').classList.remove('hidden');

            if (data.length > 0) {
                currentResources = data;
                displayResources(data);
            } else {
                document.getElementById('noResourcesMessage').classList.remove('hidden');
            }
        } catch (error) {
            console.error('Error loading resources:', error);
            document.getElementById('resourcesLoading').classList.add('hidden');
            document.getElementById('noResourcesMessage').classList.remove('hidden');
        }
    }

    function displayResources(resources) {
        const resourcesGrid = document.getElementById('resourcesGrid');
        resourcesGrid.innerHTML = '';

        resources.forEach(resource => {
            const card = createResourceCard(resource);
            resourcesGrid.appendChild(card);
        });

        // Apply current filter
        filterResources(currentFilter);
    }

    function createResourceCard(resource) {
        const card = document.createElement('div');
        card.className = 'resource-card bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-all duration-300';
        card.setAttribute('data-type', resource.type);
        card.setAttribute('data-id', resource.id);

        // Dynamic card based on resource type
        let mediaHtml = '';
        
        if (resource.thumbnail_path) {
            mediaHtml = `<img src="/storage/${resource.thumbnail_path}" alt="${resource.title}" class="w-full h-32 object-cover rounded-lg mb-3">`;
        }

        if (resource.type === 'audio') {
            card.innerHTML = `
                <div class="p-6">
                    ${mediaHtml}
                    <div class="flex items-start mb-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-music text-purple-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 mb-1">${resource.title}</h4>
                            <p class="text-sm text-gray-500">Audio • ${resource.file_size || 'Unknown size'}</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">${resource.description || 'No description available'}</p>
                    <button onclick="playResource(${resource.id})" class="w-full bg-purple-600 text-white py-2 rounded-lg font-medium hover:bg-purple-700 transition-colors">
                        <i class="fas fa-play mr-2"></i> Play Audio
                    </button>
                </div>
            `;
        } else if (resource.type === 'video') {
            card.innerHTML = `
                <div class="p-6">
                    ${mediaHtml || '<div class="w-full h-32 bg-gray-200 rounded-lg flex items-center justify-center mb-3"><i class="fas fa-video text-gray-400 text-3xl"></i></div>'}
                    <div class="flex items-start mb-4">
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-video text-red-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 mb-1">${resource.title}</h4>
                            <p class="text-sm text-gray-500">Video • ${resource.file_size || 'Unknown size'}</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">${resource.description || 'No description available'}</p>
                    <button onclick="playResource(${resource.id})" class="w-full bg-red-600 text-white py-2 rounded-lg font-medium hover:bg-red-700 transition-colors">
                        <i class="fas fa-play mr-2"></i> Watch Video
                    </button>
                </div>
            `;
        } else if (resource.type === 'pdf') {
            card.innerHTML = `
                <div class="p-6">
                    ${mediaHtml || '<div class="w-full h-32 bg-red-50 rounded-lg flex items-center justify-center mb-3"><i class="fas fa-file-pdf text-red-500 text-4xl"></i></div>'}
                    <div class="flex items-start mb-4">
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-file-pdf text-red-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 mb-1">${resource.title}</h4>
                            <p class="text-sm text-gray-500">PDF • ${resource.file_size || 'Unknown size'}</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">${resource.description || 'No description available'}</p>
                    <button onclick="viewResource(${resource.id})" class="w-full bg-red-600 text-white py-2 rounded-lg font-medium hover:bg-red-700 transition-colors">
                        <i class="fas fa-eye mr-2"></i> View PDF
                    </button>
                </div>
            `;
        } else if (resource.type === 'image') {
            card.innerHTML = `
                <div class="p-6">
                    ${mediaHtml || '<div class="w-full h-32 bg-green-50 rounded-lg flex items-center justify-center mb-3"><i class="fas fa-image text-green-500 text-4xl"></i></div>'}
                    <div class="flex items-start mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-image text-green-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 mb-1">${resource.title}</h4>
                            <p class="text-sm text-gray-500">Image • ${resource.file_size || 'Unknown size'}</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">${resource.description || 'No description available'}</p>
                    <button onclick="viewResource(${resource.id})" class="w-full bg-green-600 text-white py-2 rounded-lg font-medium hover:bg-green-700 transition-colors">
                        <i class="fas fa-eye mr-2"></i> View Image
                    </button>
                </div>
            `;
        } else {
            card.innerHTML = `
                <div class="p-6">
                    ${mediaHtml}
                    <div class="flex items-start mb-4">
                        <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-file text-gray-600 text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 mb-1">${resource.title}</h4>
                            <p class="text-sm text-gray-500">${resource.type} • ${resource.file_size || 'Unknown size'}</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">${resource.description || 'No description available'}</p>
                    <button onclick="viewResource(${resource.id})" class="w-full bg-teal-600 text-white py-2 rounded-lg font-medium hover:bg-teal-700 transition-colors">
                        <i class="fas fa-eye mr-2"></i> View Resource
                    </button>
                </div>
            `;
        }

        return card;
    }

    // ==================== FILTER FUNCTIONS ====================
    function filterResources(type) {
        console.log('Filtering resources:', type);
        currentFilter = type;
        const resources = document.querySelectorAll('#resourcesGrid .resource-card');
        const filterButtons = document.querySelectorAll('.filter-btn');

        // Update button styles
        filterButtons.forEach(button => {
            if (button.textContent.toLowerCase().includes(type) ||
                (type === 'all' && button.textContent.includes('All Resources'))) {
                button.classList.remove('bg-gray-100', 'text-gray-700');
                button.classList.add('bg-teal-600', 'text-white');
            } else {
                button.classList.remove('bg-teal-600', 'text-white');
                button.classList.add('bg-gray-100', 'text-gray-700');
            }
        });

        // Show/hide resources
        resources.forEach(resource => {
            if (type === 'all') {
                resource.style.display = 'block';
            } else {
                resource.style.display = resource.getAttribute('data-type') === type ? 'block' : 'none';
            }
        });
    }

    // ==================== NAVIGATION FUNCTIONS ====================
    function backToCircles() {
        console.log('Back to circles');
        document.getElementById('circlesGrid').classList.remove('hidden');
        document.getElementById('subCirclesContainer').classList.add('hidden');
        document.getElementById('categoriesContainer').classList.add('hidden');
        document.getElementById('resourcesContainer').classList.add('hidden');
        
        currentCircleId = null;
        currentCircleTitle = '';
        currentSubCircleId = null;
        currentSubCircleTitle = '';
        currentCategoryId = null;
        currentCategoryTitle = '';
    }

    function backToSubCircles() {
        console.log('Back to sub-circles');
        document.getElementById('subCirclesContainer').classList.remove('hidden');
        document.getElementById('categoriesContainer').classList.add('hidden');
        document.getElementById('resourcesContainer').classList.add('hidden');
        
        currentSubCircleId = null;
        currentSubCircleTitle = '';
        currentCategoryId = null;
        currentCategoryTitle = '';
    }

    function backToCategories() {
        console.log('Back to categories');
        document.getElementById('categoriesContainer').classList.remove('hidden');
        document.getElementById('resourcesContainer').classList.add('hidden');
        
        currentCategoryId = null;
        currentCategoryTitle = '';
    }

    // ==================== RESOURCE ACTION FUNCTIONS ====================
    function playResource(resourceId) {
        const resource = currentResources.find(r => r.id === resourceId);
        if (resource && resource.file_path) {
            window.open('/storage/' + resource.file_path, '_blank');
        } else {
            alert('Resource file not available');
        }
    }

    function viewResource(resourceId) {
        const resource = currentResources.find(r => r.id === resourceId);
        if (resource && resource.file_path) {
            window.open('/storage/' + resource.file_path, '_blank');
        } else if (resource && resource.external_url) {
            window.open(resource.external_url, '_blank');
        } else {
            alert('Resource not available');
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Resource tab initialized');
    });
    fetch(`/api/categories/circle/${circleId}`)
    .then(response => response.json())
    .then(categories => {
        console.log('Categories with resources:', categories);
        // Populate your category dropdown
    });

// Get all categories with resource counts
fetch(`/api/categories/circle/${circleId}/with-counts`)
    .then(response => response.json())
    .then(categories => {
        console.log('All categories with counts:', categories);
        // Show categories with resource_count > 0
        const categoriesWithResources = categories.filter(c => c.has_resources);
    });
</script>