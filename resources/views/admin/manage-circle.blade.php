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
                                        {{ $circle->location['state'] ?? '' }}, {{ $circle->location['country'] ?? '' }}
                                    </div>
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

    <!-- Circle Modal with Country-State-District Selection -->
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
                        
                        <!-- Location Selection - Country, State, District -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Country *</label>
                                <select id="country" name="country" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="">Select Country</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">State *</label>
                                <select id="state" name="state" required disabled
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="">First select a country</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">District/City *</label>
                                <select id="district" name="district" required disabled
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                                    <option value="">First select a state</option>
                                </select>
                            </div>

                            <!-- Circle Details -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Circle Title *</label>
                                <input type="text" id="title" name="title" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                                       placeholder="Enter circle title">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Icon (Optional)</label>
                                <input type="text" id="icon" name="icon"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                                       placeholder="fas fa-circle">
                                <p class="text-xs text-gray-500 mt-1">Font Awesome icon class</p>
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
    // DOM Elements
    const countrySelect = document.getElementById('country');
    const stateSelect = document.getElementById('state');
    const districtSelect = document.getElementById('district');
    const locationDataInput = document.getElementById('location_data');

    // Store locations data
    let countriesData = [];
    let statesData = [];

    // Load all countries on page load
    async function loadCountries() {
        try {
            const res = await fetch("https://countriesnow.space/api/v0.1/countries/positions");
            const result = await res.json();

            countriesData = result.data;
            
            countrySelect.innerHTML = `<option value="">Select Country</option>`;
            countriesData.forEach(item => {
                countrySelect.innerHTML += `<option value="${item.name}">${item.name}</option>`;
            });

            // Default select India
            countrySelect.value = "India";
            if (countrySelect.value) {
                await loadStates("India");
            }
        } catch (error) {
            console.error('Error loading countries:', error);
            countrySelect.innerHTML = `<option value="">Error loading countries</option>`;
        }
    }

    // Load states of selected country
    async function loadStates(country) {
        try {
            stateSelect.disabled = true;
            stateSelect.innerHTML = `<option value="">Loading states...</option>`;
            districtSelect.disabled = true;
            districtSelect.innerHTML = `<option value="">First select a state</option>`;
            
            const res = await fetch("https://countriesnow.space/api/v0.1/countries/states", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ country })
            });

            const result = await res.json();

            stateSelect.innerHTML = `<option value="">Select State</option>`;
            
            if (result.data && result.data.states && result.data.states.length > 0) {
                statesData = result.data.states;
                statesData.forEach(state => {
                    stateSelect.innerHTML += `<option value="${state.name}">${state.name}</option>`;
                });
                stateSelect.disabled = false;
            } else {
                stateSelect.innerHTML = `<option value="">No states available</option>`;
            }
        } catch (error) {
            console.error('Error loading states:', error);
            stateSelect.innerHTML = `<option value="">Error loading states</option>`;
        }
    }

    // Load districts/cities of selected state
    async function loadDistricts(country, state) {
        try {
            districtSelect.disabled = true;
            districtSelect.innerHTML = `<option value="">Loading districts...</option>`;
            
            const res = await fetch("https://countriesnow.space/api/v0.1/countries/state/cities", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ country, state })
            });

            const result = await res.json();

            districtSelect.innerHTML = `<option value="">Select District</option>`;

            if (result.data && result.data.length > 0) {
                result.data.forEach(city => {
                    districtSelect.innerHTML += `<option value="${city}">${city}</option>`;
                });
                districtSelect.disabled = false;
            } else {
                districtSelect.innerHTML = `<option value="">No districts available</option>`;
            }
        } catch (error) {
            console.error('Error loading districts:', error);
            districtSelect.innerHTML = `<option value="">Error loading districts</option>`;
        }
    }

    // Update location data when all selections are made
    function updateLocationData() {
        if (countrySelect.value && stateSelect.value && districtSelect.value) {
            const locationData = {
                country: countrySelect.value,
                state: stateSelect.value,
                city: districtSelect.value,
                formatted_address: `${districtSelect.value}, ${stateSelect.value}, ${countrySelect.value}`,
                display: `${districtSelect.value}, ${stateSelect.value}, ${countrySelect.value}`
            };
            
            locationDataInput.value = JSON.stringify(locationData);
        }
    }

    // Event Listeners
    countrySelect.addEventListener('change', async function() {
        if (this.value) {
            await loadStates(this.value);
            districtSelect.innerHTML = `<option value="">First select a state</option>`;
            districtSelect.disabled = true;
        } else {
            stateSelect.innerHTML = `<option value="">First select a country</option>`;
            stateSelect.disabled = true;
            districtSelect.innerHTML = `<option value="">First select a state</option>`;
            districtSelect.disabled = true;
        }
        updateLocationData();
    });

    stateSelect.addEventListener('change', async function() {
        if (countrySelect.value && this.value) {
            await loadDistricts(countrySelect.value, this.value);
        } else {
            districtSelect.innerHTML = `<option value="">First select a state</option>`;
            districtSelect.disabled = true;
        }
        updateLocationData();
    });

    districtSelect.addEventListener('change', updateLocationData);

    // Modal Functions
    window.openCircleModal = function(id = null, title = '', icon = '', description = '', status = true, location = null) {
        const modal = document.getElementById('circleModal');
        const modalTitle = document.getElementById('modalTitle');
        const form = document.getElementById('circleForm');
        
        // Reset form
        form.reset();
        document.getElementById('circleId').value = '';
        document.getElementById('formMethod').value = 'POST';
        
        // Reset location dropdowns
        countrySelect.innerHTML = '<option value="">Select Country</option>';
        stateSelect.innerHTML = '<option value="">First select a country</option>';
        districtSelect.innerHTML = '<option value="">First select a state</option>';
        stateSelect.disabled = true;
        districtSelect.disabled = true;
        
        // Load countries
        loadCountries().then(() => {
            // If editing and location exists, set the values
            if (id && location) {
                // Small delay to ensure countries are loaded
                setTimeout(() => {
                    if (location.country) {
                        countrySelect.value = location.country;
                        
                        // Load states for the country
                        loadStates(location.country).then(() => {
                            if (location.state) {
                                // Small delay for states to load
                                setTimeout(() => {
                                    stateSelect.value = location.state;
                                    
                                    // Load districts for the state
                                    loadDistricts(location.country, location.state).then(() => {
                                        if (location.city) {
                                            setTimeout(() => {
                                                districtSelect.value = location.city;
                                                updateLocationData();
                                            }, 500);
                                        }
                                    });
                                }, 500);
                            }
                        });
                    }
                }, 1000);
            }
        });
        
        if (id) {
            modalTitle.textContent = 'Edit Circle';
            document.getElementById('circleId').value = id;
            document.getElementById('title').value = title;
            document.getElementById('icon').value = icon || '';
            document.getElementById('description').value = description || '';
            document.getElementById('status').checked = status;
            
            form.action = `/admin/circles/${id}`;
            document.getElementById('formMethod').value = 'PUT';
        } else {
            modalTitle.textContent = 'Add New Circle';
            form.action = `/admin/circles`;
        }
        
        modal.classList.remove('hidden');
    };

    window.closeCircleModal = function() {
        document.getElementById('circleModal').classList.add('hidden');
    };

    window.deleteCircle = function(id, title) {
        document.getElementById('deleteMessage').textContent = `Delete "${title}"?`;
        document.getElementById('deleteForm').action = `/admin/circles/${id}`;
        document.getElementById('deleteModal').classList.remove('hidden');
    };

    window.closeDeleteModal = function() {
        document.getElementById('deleteModal').classList.add('hidden');
    };

    // Close modals on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeCircleModal();
            closeDeleteModal();
        }
    });

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadCountries();
    });
</script>
@endpush