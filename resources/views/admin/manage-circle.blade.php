@extends('layout.admin-layout')

@section('title', 'Manage Circles')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manage Circles</h1>
        <p class="text-gray-600 mt-2">Manage your circles and locations</p>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Add Circle Button -->
    <div class="mb-6">
        <button onclick="openCircleModal()" 
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700">
            <i class="fas fa-plus-circle"></i>
            Add New Circle
        </button>
    </div>

    <!-- Circles Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Circle</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Location</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($circles as $circle)
                    <tr>
                        <td class="px-6 py-4 text-sm">{{ $circle->id }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <i class="{{ $circle->icon ?? 'fas fa-circle' }} mr-2 text-green-500"></i>
                                <div>
                                    <div class="font-medium">{{ $circle->title }}</div>
                                    @if($circle->description)
                                        <div class="text-xs text-gray-500">{{ $circle->description }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($circle->location)
                                <div class="text-sm">
                                    <div class="font-medium">{{ $circle->location['city'] ?? 'N/A' }}</div>
                                    <div class="text-xs text-gray-500">
                                        {{ $circle->location['state'] ?? '' }} {{ $circle->location['country'] ?? '' }}
                                    </div>
                                    @if(isset($circle->location['latitude']))
                                        <div class="text-xs text-gray-400">
                                            <i class="fas fa-map-marker-alt"></i> 
                                            {{ number_format($circle->location['latitude'], 4) }}, 
                                            {{ number_format($circle->location['longitude'], 4) }}
                                        </div>
                                    @endif
                                </div>
                            @else
                                <span class="text-gray-400">No location</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full {{ $circle->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $circle->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <button onclick="openCircleModal({{ $circle->id }}, '{{ addslashes($circle->title) }}', '{{ addslashes($circle->icon ?? '') }}', '{{ addslashes($circle->description ?? '') }}', {{ $circle->status ? 'true' : 'false' }}, {{ json_encode($circle->location) }})"
                                    class="text-blue-600 hover:text-blue-900 p-2 rounded">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteCircle({{ $circle->id }}, '{{ addslashes($circle->title) }}')"
                                    class="text-red-600 hover:text-red-900 p-2 rounded">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            No circles found. Add your first circle!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Simple Modal with just Search -->
    <div id="circleModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="min-h-screen flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4" id="modalTitle">Add New Circle</h3>
                    
                    <form id="circleForm" method="POST">
                        @csrf
                        <input type="hidden" id="formMethod" name="_method" value="POST">
                        <input type="hidden" id="circleId" name="id">
                        <input type="hidden" id="location_data" name="location_data">
                        
                        <!-- Simple Form -->
                        <div class="space-y-4">
                                <!-- Simple Location Search -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Search Location</label>
                                <div class="relative">
                                    <input type="text" id="location_search" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded-lg pl-10"
                                           placeholder="Type city name (e.g., Hyderabad)"
                                           autocomplete="off">
                                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    
                                    <!-- Location Results Dropdown -->
                                    <div id="location_results" class="absolute z-20 w-full bg-white border border-gray-300 rounded-lg mt-1 max-h-60 overflow-y-auto hidden shadow-lg"></div>
                                </div>
                                
                                <!-- Selected Location Display -->
                                <div id="selected_location" class="mt-2 p-2 bg-blue-50 rounded-lg hidden">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <span class="text-sm font-medium text-blue-800" id="selected_location_name"></span>
                                            <p class="text-xs text-blue-600" id="selected_location_details"></p>
                                        </div>
                                        <button type="button" onclick="clearSelectedLocation()" class="text-blue-500 hover:text-blue-700">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Circle Title *</label>
                                <input type="text" id="title" name="title" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                                       placeholder="Enter circle title">
                            </div>
                            
                        
                            
                            <!-- Optional Fields -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Icon (Optional)</label>
                                <input type="text" id="icon" name="icon"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                                       placeholder="fas fa-circle">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Description (Optional)</label>
                                <textarea id="description" name="description" rows="2"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                                          placeholder="Enter description"></textarea>
                            </div>
                            
                            <div class="flex items-center">
                                <input type="checkbox" id="status" name="status" value="1" checked
                                       class="h-4 w-4 text-blue-600 rounded border-gray-300">
                                <label for="status" class="ml-2 text-sm text-gray-700">Active</label>
                            </div>
                        </div>
                        
                        <div class="flex justify-end space-x-3 mt-6">
                            <button type="button" onclick="closeCircleModal()"
                                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                                Cancel
                            </button>
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                Save Circle
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="min-h-screen flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-lg max-w-sm w-full p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Delete Circle</h3>
                <p class="text-gray-600 mb-6" id="deleteMessage">Are you sure?</p>
                
                <div class="flex justify-end space-x-3">
                    <button onclick="closeDeleteModal()" class="px-4 py-2 border rounded-lg">Cancel</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    let searchTimeout;
    const searchInput = document.getElementById('location_search');
    const resultsDiv = document.getElementById('location_results');
    const selectedLocationDiv = document.getElementById('selected_location');
    const locationDataInput = document.getElementById('location_data');
    let selectedLocation = null;

    // Add loader HTML
    const loaderHTML = `
        <div class="px-4 py-3 text-gray-500 flex items-center justify-center">
            <svg class="animate-spin h-5 w-5 text-blue-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Searching locations...
        </div>
    `;

    // Location Search
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value.trim();
            
            if (query.length < 2) {
                resultsDiv.classList.add('hidden');
                return;
            }
            
            // Show loader
            resultsDiv.innerHTML = loaderHTML;
            resultsDiv.classList.remove('hidden');
            
            searchTimeout = setTimeout(() => {
                fetch(`/admin/circles/search-locations?q=${encodeURIComponent(query)}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(locations => {
                        if (locations.length > 0) {
                            resultsDiv.innerHTML = locations.map(loc => `
                                <div class="px-4 py-3 hover:bg-gray-50 cursor-pointer border-b last:border-b-0 transition"
                                     onclick="selectLocation(${JSON.stringify(loc).replace(/"/g, '&quot;')})">
                                    <div class="font-medium text-gray-800">${loc.name.split(',')[0]}</div>
                                    <div class="text-sm text-gray-500">${loc.display || loc.name}</div>
                                </div>
                            `).join('');
                        } else {
                            resultsDiv.innerHTML = `
                                <div class="px-4 py-6 text-gray-500 text-center">
                                    <i class="fas fa-map-marker-alt text-gray-300 text-2xl mb-2"></i>
                                    <div>No locations found for "${query}"</div>
                                    <div class="text-xs mt-1">Try a different search term</div>
                                </div>
                            `;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        resultsDiv.innerHTML = `
                            <div class="px-4 py-6 text-red-500 text-center">
                                <i class="fas fa-exclamation-triangle text-red-300 text-2xl mb-2"></i>
                                <div>Failed to fetch locations</div>
                                <div class="text-xs mt-1">Please try again</div>
                            </div>
                        `;
                    });
            }, 500); // थोड़ा delay ताकि loader दिखे
        });
    }

    // Select Location
    window.selectLocation = function(location) {
        selectedLocation = location;
        
        // Show selected location with animation
        document.getElementById('selected_location_name').textContent = location.city || location.name.split(',')[0];
        document.getElementById('selected_location_details').textContent = location.display || location.name;
        selectedLocationDiv.classList.remove('hidden');
        selectedLocationDiv.classList.add('animate-pulse');
        setTimeout(() => {
            selectedLocationDiv.classList.remove('animate-pulse');
        }, 500);
        
        // Store location data in hidden input
        locationDataInput.value = JSON.stringify({
            name: location.name,
            city: location.city,
            state: location.state,
            country: location.country,
            pincode: location.pincode,
            latitude: location.latitude,
            longitude: location.longitude,
            display: location.display
        });
        
        // Clear and hide results
        searchInput.value = location.city || location.name.split(',')[0];
        resultsDiv.classList.add('hidden');
    };

    // Clear Selected Location
    window.clearSelectedLocation = function() {
        selectedLocation = null;
        selectedLocationDiv.classList.add('hidden');
        searchInput.value = '';
        locationDataInput.value = '';
        searchInput.focus(); // फोकस वापस search box पर
    };

    // Open Modal
    window.openCircleModal = function(id = null, title = '', icon = '', description = '', status = true, location = null) {
        const modal = document.getElementById('circleModal');
        const modalTitle = document.getElementById('modalTitle');
        const form = document.getElementById('circleForm');
        
        // Reset form
        form.reset();
        clearSelectedLocation();
        document.getElementById('circleId').value = '';
        document.getElementById('formMethod').value = 'POST';
        
        if (id) {
            modalTitle.textContent = 'Edit Circle';
            document.getElementById('circleId').value = id;
            document.getElementById('title').value = title;
            document.getElementById('icon').value = icon || '';
            document.getElementById('description').value = description || '';
            document.getElementById('status').checked = status;
            
            // Load location if exists
            if (location) {
                // Small delay to ensure modal is rendered
                setTimeout(() => {
                    selectLocation({
                        city: location.city,
                        state: location.state,
                        country: location.country,
                        pincode: location.pincode,
                        latitude: location.latitude,
                        longitude: location.longitude,
                        name: location.formatted_address || location.city || 'Unknown location',
                        display: location.display || `${location.city || ''} ${location.state || ''} ${location.country || ''}`.trim()
                    });
                }, 100);
            }
            
            form.action = `/admin/circles/${id}`;
            document.getElementById('formMethod').value = 'PUT';
        } else {
            modalTitle.textContent = 'Add New Circle';
            form.action = `/admin/circles`;
        }
        
        modal.classList.remove('hidden');
        // Focus on search input when modal opens
        setTimeout(() => {
            searchInput?.focus();
        }, 200);
    };

    window.closeCircleModal = function() {
        document.getElementById('circleModal').classList.add('hidden');
        resultsDiv.classList.add('hidden');
    };

    window.deleteCircle = function(id, title) {
        document.getElementById('deleteMessage').textContent = `Delete "${title}"?`;
        document.getElementById('deleteForm').action = `/admin/circles/${id}`;
        document.getElementById('deleteModal').classList.remove('hidden');
    };

    window.closeDeleteModal = function() {
        document.getElementById('deleteModal').classList.add('hidden');
    };

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!searchInput?.contains(e.target) && !resultsDiv?.contains(e.target)) {
            resultsDiv?.classList.add('hidden');
        }
    });

    // Close modals on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeCircleModal();
            closeDeleteModal();
        }
    });

    // Handle enter key in search input
    if (searchInput) {
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault(); // Prevent form submission
            }
        });
    }
</script>
@endpush