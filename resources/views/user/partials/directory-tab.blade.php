<div class="max-w-6xl mx-auto">
    <!-- Filters Section -->
    <div class="bg-white rounded-xl shadow-md p-3 sm:p-4 mb-4 sm:mb-6 border border-gray-200">
        <div class="flex flex-wrap gap-2 sm:gap-3 items-center">
            <!-- Sort by -->
            <div class="relative w-full sm:w-auto min-w-[150px]">
                <select id="sortBy" onchange="filterDirectory()"
                    class="appearance-none bg-white border border-gray-300 rounded-lg pl-3 sm:pl-4 pr-8 sm:pr-10 py-2 sm:py-2.5 text-sm sm:text-base text-gray-700 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="newest">Sort by: Newest</option>
                    <option value="oldest">Sort by: Oldest</option>
                    <option value="name_asc">Name: A to Z</option>
                    <option value="name_desc">Name: Z to A</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <i class="fas fa-chevron-down text-sm sm:text-base"></i>
                </div>
            </div>

            <!-- Country Filter -->
            <div class="relative w-full sm:w-auto min-w-[150px]">
                <select id="filterCountry" name="country" onchange="filterDirectory()"
                    class="appearance-none bg-white border border-gray-300 rounded-lg pl-3 sm:pl-4 pr-8 sm:pr-10 py-2 sm:py-2.5 text-sm sm:text-base text-gray-700 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Countries</option>
                    @foreach($allUsers->pluck('country')->unique()->filter() as $country)
                        <option value="{{ $country }}">{{ $country }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <i class="fas fa-chevron-down text-sm sm:text-base"></i>
                </div>
            </div>

            <!-- State Filter -->
            <div class="relative w-full sm:w-auto min-w-[150px]">
                <select id="filterState" name="state" onchange="filterDirectory()"
                    class="appearance-none bg-white border border-gray-300 rounded-lg pl-3 sm:pl-4 pr-8 sm:pr-10 py-2 sm:py-2.5 text-sm sm:text-base text-gray-700 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All States</option>
                    @foreach($allUsers->pluck('state')->unique()->filter() as $state)
                        <option value="{{ $state }}">{{ $state }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <i class="fas fa-chevron-down text-sm sm:text-base"></i>
                </div>
            </div>

            <!-- District Filter -->
            <div class="relative w-full sm:w-auto min-w-[150px]">
                <select id="filterDistrict" name="district" onchange="filterDirectory()"
                    class="appearance-none bg-white border border-gray-300 rounded-lg pl-3 sm:pl-4 pr-8 sm:pr-10 py-2 sm:py-2.5 text-sm sm:text-base text-gray-700 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Districts</option>
                    @foreach($allUsers->pluck('district')->unique()->filter() as $district)
                        <option value="{{ $district }}">{{ $district }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <i class="fas fa-chevron-down text-sm sm:text-base"></i>
                </div>
            </div>

            <!-- Circle Filter -->
            <div class="relative w-full sm:w-auto min-w-[150px]">
                <select id="filterCircle" name="circle_id" onchange="filterDirectory()"
                    class="appearance-none bg-white border border-gray-300 rounded-lg pl-3 sm:pl-4 pr-8 sm:pr-10 py-2 sm:py-2.5 text-sm sm:text-base text-gray-700 w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Circles</option>
                    @foreach($circles as $circle)
                        <option value="{{ $circle->id }}">{{ $circle->circle }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <i class="fas fa-chevron-down text-sm sm:text-base"></i>
                </div>
            </div>

            <!-- Search Box -->
            <div class="relative flex-1 min-w-[200px]">
                <input type="text" id="searchUser" onkeyup="filterDirectory()"
                    class="w-full px-4 py-2.5 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Search by name or occupation...">
                <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
            </div>
        </div>
    </div>

    <!-- User Directory Listings -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main User Listings -->
        <div class="lg:col-span-2">
            <div id="userListings" class="space-y-6">
                @forelse($users as $user)
                    <div class="user-card bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-shadow block" 
                         data-country="{{ $user->country }}"
                         data-state="{{ $user->state }}"
                         data-district="{{ $user->district }}"
                         data-circle="{{ $user->circle_id }}"
                         data-name="{{ strtolower($user->full_name) }}"
                         data-occupation="{{ strtolower($user->occupation ?? '') }}"
                         data-created="{{ $user->created_at->timestamp }}">
                        <div class="p-6">
                            <div class="flex flex-col md:flex-row md:items-start gap-6">
                                <!-- User Avatar/Initials -->
                                <div class="md:w-1/3">
                                    <div class="relative h-48 md:h-40 rounded-lg overflow-hidden bg-gradient-to-br from-blue-50 to-indigo-100">
                                        @php
                                            $colors = ['bg-blue-500', 'bg-green-500', 'bg-purple-500', 'bg-red-500', 'bg-yellow-500', 'bg-indigo-500', 'bg-pink-500'];
                                            $randomColor = $colors[$user->id % count($colors)];
                                        @endphp
                                        <div class="w-full h-full flex items-center justify-center {{ $randomColor }}">
                                            <span class="text-5xl font-bold text-white">
                                                {{ strtoupper(substr($user->full_name, 0, 1)) }}
                                            </span>
                                        </div>
                                        
                                        <!-- Trust Verified Badge -->
                                        @if($user->verified)
                                            <div class="absolute top-3 left-3">
                                                <span class="bg-green-600 text-white text-xs font-bold px-2 py-1 rounded-full flex items-center">
                                                    <i class="fas fa-check-circle mr-1 text-xs"></i>
                                                    Verified
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- User Details -->
                                <div class="md:w-2/3">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h3 class="text-xl font-bold text-gray-800">{{ $user->full_name }}</h3>
                                            @if($user->occupation)
                                                <p class="text-sm text-gray-600">{{ $user->occupation }}</p>
                                            @endif
                                            @if($user->circle)
                                                <p class="text-xs text-blue-600 mt-1">
                                                    <i class="fas fa-users mr-1"></i>{{ $user->circle->circle ?? 'No Circle' }}
                                                    @if($user->subCircle)
                                                        / {{ $user->subCircle->subcircle }}
                                                    @endif
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                  <!-- Interests/Occupation Tags -->
@if($user->interests || $user->occupation)
    <div class="mb-4">
        <div class="flex flex-wrap gap-2">
            @if($user->occupation)
                <span class="inline-flex items-center text-sm bg-blue-100 text-blue-700 px-3 py-1 rounded-full">
                    <i class="fas fa-briefcase mr-1 text-xs"></i>{{ $user->occupation }}
                </span>
            @endif
            
            {{-- Use the accessor --}}
            @foreach($user->interests_array as $interest)
                <span class="inline-flex items-center text-sm bg-gray-100 text-gray-700 px-3 py-1 rounded-full">
                    {{ trim($interest) }}
                </span>
            @endforeach
        </div>
    </div>
@endif

                                    <!-- Location -->
                                    <div class="flex items-center text-gray-600 mb-3">
                                        <i class="fas fa-map-marker-alt mr-2 text-red-500"></i>
                                        <span>
                                            @if($user->district){{ $user->district }}, @endif
                                            @if($user->state){{ $user->state }}, @endif
                                            @if($user->country){{ $user->country }}@endif
                                            @if($user->pincode) - {{ $user->pincode }}@endif
                                        </span>
                                    </div>

                                    <!-- Contact Information -->
                                    <div class="pt-4 border-t border-gray-200">
                                        <div class="flex flex-wrap items-center gap-3 mb-4">
                                            @if($user->phone)
                                                <div class="flex items-center text-gray-700">
                                                    <i class="fas fa-phone-alt text-blue-600 mr-2"></i>
                                                    <span>{{ $user->phone }}</span>
                                                </div>
                                            @endif
                                            
                                            @if($user->phone)
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->phone) }}" 
                                                   target="_blank"
                                                   class="text-green-600 hover:text-green-700 font-medium">
                                                    <i class="fab fa-whatsapp mr-1"></i>WhatsApp
                                                </a>
                                            @endif
                                            
                                            @if($user->email)
                                                <button onclick="showEmail('{{ $user->email }}')" 
                                                        class="text-blue-600 hover:text-blue-700 font-medium">
                                                    <i class="fas fa-envelope mr-1"></i>Email
                                                </button>
                                            @endif
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="flex gap-3">
                                            <button onclick="contactUser({{ $user->id }}, '{{ $user->full_name }}')"
                                                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg transition-colors">
                                                <i class="fas fa-handshake mr-2"></i>Connect
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl shadow-md p-12 text-center border border-gray-200">
                        <div class="text-6xl mb-4">👥</div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">No Users Found</h3>
                        <p class="text-gray-600">There are no registered users to display yet.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($users instanceof \Illuminate\Pagination\LengthAwarePaginator && $users->hasPages())
                <div class="mt-8">
                    {{ $users->links() }}
                </div>
            @endif
        </div>

        <!-- Contact Request Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6 border border-gray-200 sticky top-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Connect with Members</h3>
                <p class="text-gray-600 mb-6">Get contact details and connect instantly</p>

                <!-- Interest Selection -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        What type of professional are you looking for?
                    </label>
                    <div class="space-y-2 max-h-48 overflow-y-auto">
                        @php
                            $occupations = $allUsers->pluck('occupation')->unique()->filter()->take(8);
                        @endphp
                        @forelse($occupations as $occ)
                            <label class="flex items-center p-2 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" name="interest[]" value="{{ $occ }}" class="interest-checkbox h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                                <span class="ml-3 text-sm text-gray-700">{{ $occ }}</span>
                            </label>
                        @empty
                            <p class="text-sm text-gray-500">No occupations available</p>
                        @endforelse
                    </div>
                </div>

                <!-- Contact Form -->
                <form id="contactRequestForm" onsubmit="submitContactRequest(event)" class="space-y-4">
                    @csrf
                    <input type="hidden" id="selectedUserId" name="user_id" value="">
                    
                    <div id="selectedUserDisplay" class="hidden bg-blue-50 p-3 rounded-lg mb-2">
                        <p class="text-sm text-blue-700">
                            <i class="fas fa-user mr-1"></i>
                            Connecting with: <span id="selectedUserName" class="font-semibold"></span>
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Your Name</label>
                        <input type="text" name="name" id="contactName" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter your name">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" name="phone" id="contactPhone" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter your phone number">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email (Optional)</label>
                        <input type="email" name="email" id="contactEmail"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter your email">
                    </div>

                    <!-- Message -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Message (Optional)</label>
                        <textarea name="message" id="contactMessage" rows="3"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Tell us what you're looking for..."></textarea>
                    </div>

                    <!-- Terms & Privacy -->
                    <div class="flex items-start">
                        <input type="checkbox" id="terms" required
                            class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mt-1">
                        <label for="terms" class="ml-2 text-sm text-gray-600">
                            I agree to the 
                            <a href="#" class="text-blue-600 hover:underline">Terms & Conditions</a>
                            and 
                            <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="submitContactBtn"
                        class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3.5 px-6 rounded-lg transition-all duration-300 shadow-md hover:shadow-lg">
                        <span class="submit-text">Send Connection Request</span>
                        <span class="submit-spinner hidden"><i class="fas fa-spinner fa-spin mr-2"></i>Sending...</span>
                    </button>
                </form>

                <!-- Features List -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="space-y-3">
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-shield-alt text-green-500 mr-2"></i>
                            <span>Verified member listings</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-clock text-blue-500 mr-2"></i>
                            <span>Quick response guaranteed</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-handshake text-purple-500 mr-2"></i>
                            <span>Direct connect with members</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <i class="fas fa-lock text-green-500 mr-2"></i>
                            <span>Your data is secure with us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Directory filtering function
function filterDirectory() {
    console.log('Filter function called'); // Debug log
    
    // Get filter values
    const sortBy = document.getElementById('sortBy')?.value || 'newest';
    const country = document.getElementById('filterCountry')?.value || '';
    const state = document.getElementById('filterState')?.value || '';
    const district = document.getElementById('filterDistrict')?.value || '';
    const circle = document.getElementById('filterCircle')?.value || '';
    const searchTerm = document.getElementById('searchUser')?.value.toLowerCase() || '';
    
    console.log('Filters:', { sortBy, country, state, district, circle, searchTerm }); // Debug log
    
    // Get all user cards
    const userCards = document.querySelectorAll('.user-card');
    console.log('Found user cards:', userCards.length); // Debug log
    
    let visibleUsers = [];
    
    // First, filter by criteria
    userCards.forEach(card => {
        let showCard = true;
        
        // Get card data
        const cardCountry = card.dataset.country || '';
        const cardState = card.dataset.state || '';
        const cardDistrict = card.dataset.district || '';
        const cardCircle = card.dataset.circle || '';
        const cardName = card.dataset.name || '';
        const cardOccupation = card.dataset.occupation || '';
        
        // Country filter
        if (country && cardCountry !== country) {
            showCard = false;
        }
        
        // State filter
        if (showCard && state && cardState !== state) {
            showCard = false;
        }
        
        // District filter
        if (showCard && district && cardDistrict !== district) {
            showCard = false;
        }
        
        // Circle filter
        if (showCard && circle && cardCircle !== circle) {
            showCard = false;
        }
        
        // Search filter
        if (showCard && searchTerm) {
            if (!cardName.includes(searchTerm) && !cardOccupation.includes(searchTerm)) {
                showCard = false;
            }
        }
        
        // Show or hide card
        if (showCard) {
            card.style.display = 'block';
            visibleUsers.push(card);
        } else {
            card.style.display = 'none';
        }
    });
    
    console.log('Visible users:', visibleUsers.length); // Debug log
    
    // Sort visible users
    if (sortBy && visibleUsers.length > 0) {
        const container = document.getElementById('userListings');
        
        // Sort the array
        visibleUsers.sort((a, b) => {
            const aVal = a.dataset[sortBy === 'name_asc' || sortBy === 'name_desc' ? 'name' : 'created'];
            const bVal = b.dataset[sortBy === 'name_asc' || sortBy === 'name_desc' ? 'name' : 'created'];
            
            switch(sortBy) {
                case 'newest':
                    return parseInt(b.dataset.created) - parseInt(a.dataset.created);
                case 'oldest':
                    return parseInt(a.dataset.created) - parseInt(b.dataset.created);
                case 'name_asc':
                    return a.dataset.name.localeCompare(b.dataset.name);
                case 'name_desc':
                    return b.dataset.name.localeCompare(a.dataset.name);
                default:
                    return 0;
            }
        });
        
        // Reorder in DOM
        visibleUsers.forEach(card => {
            container.appendChild(card);
        });
    }
    
    // Show/hide no results message
    const noResultsMsg = document.getElementById('noResultsMessage');
    if (visibleUsers.length === 0) {
        if (!noResultsMsg) {
            const msg = document.createElement('div');
            msg.id = 'noResultsMessage';
            msg.className = 'bg-white rounded-xl shadow-md p-12 text-center border border-gray-200 col-span-2';
            msg.innerHTML = `
                <div class="text-6xl mb-4">🔍</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">No Members Found</h3>
                <p class="text-gray-600">No members match your search criteria. Try adjusting your filters.</p>
            `;
            document.getElementById('userListings').appendChild(msg);
        }
    } else if (noResultsMsg) {
        noResultsMsg.remove();
    }
}

// Initialize filter event listeners
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded - initializing filters'); // Debug log
    
    // Add event listeners to filter dropdowns
    const filterIds = ['sortBy', 'filterCountry', 'filterState', 'filterDistrict', 'filterCircle'];
    
    filterIds.forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            element.addEventListener('change', function(e) {
                console.log('Filter changed:', id, e.target.value); // Debug log
                filterDirectory();
            });
        } else {
            console.log('Element not found:', id); // Debug log
        }
    });
    
    // Search input with debounce
    const searchInput = document.getElementById('searchUser');
    if (searchInput) {
        let timeout;
        searchInput.addEventListener('keyup', function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                console.log('Searching:', this.value); // Debug log
                filterDirectory();
            }, 300);
        });
    }
    
    // Initial filter to ensure all cards are visible
    setTimeout(filterDirectory, 500);
});
</script>