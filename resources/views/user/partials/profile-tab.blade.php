{{-- resources/views/user/partials/profile-tab.blade.php --}}

<div class="max-w-4xl mx-auto">
    @if($user)
        {{-- User is logged in - Show profile --}}
        @php
            // Calculate profile completion
            $fields = [
                'full_name' => 15, 'email' => 10, 'phone' => 15, 'occupation' => 15,
                'interests' => 15, 'circle_id' => 15, 'sub_circle_id' => 5,
                'country' => 3, 'state' => 3, 'district' => 2, 'pincode' => 2
            ];
            
            $completedFields = 0;
            $totalWeight = array_sum($fields);
            
            foreach($fields as $field => $weight) {
                if(!empty($user->$field)) {
                    $completedFields += $weight;
                }
            }
            
            $completionPercentage = min(round(($completedFields / $totalWeight) * 100), 100);
            
            // Decode interests
            $interests = [];
            if($user->interests) {
                $interests = is_string($user->interests) 
                    ? json_decode($user->interests, true) 
                    : $user->interests;
                $interests = is_array($interests) ? $interests : [];
            }
        @endphp

        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
            <!-- Cover Photo -->
            <div class="bg-gradient-to-r from-teal-600 to-cyan-600 h-32 relative">
                <!-- Edit Profile Button -->
                <button onclick="openEditProfileModal()" 
                        class="absolute bottom-4 right-4 bg-white/90 hover:bg-white text-gray-700 px-4 py-2 rounded-lg text-sm font-medium shadow-md transition">
                    <i class="fas fa-edit mr-2"></i>Edit Profile
                </button>
            </div>

            <!-- Profile Content -->
            <div class="px-4 sm:px-8 pb-8 relative">
                <!-- Profile Picture -->
                <div class="relative -mt-16 sm:-mt-20 mb-4 flex justify-center">
                    <div class="relative group">
                        <div class="w-24 h-24 sm:w-32 sm:h-32 rounded-full border-4 border-white shadow-lg overflow-hidden bg-gradient-to-br from-teal-100 to-cyan-100">
                            <div class="w-full h-full flex items-center justify-center bg-teal-600">
                                <span class="text-3xl sm:text-4xl font-bold text-white">
                                    {{ strtoupper(substr($user->full_name, 0, 1)) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Info -->
                <div class="text-center mb-6">
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-800">{{ $user->full_name }}</h3>
                    
                    @if($user->occupation)
                        <p class="text-gray-600">{{ $user->occupation }}</p>
                    @endif
                    
                    @if($user->verified)
                        <span class="inline-flex items-center mt-2 bg-green-100 text-green-700 text-sm px-3 py-1 rounded-full">
                            <i class="fas fa-check-circle mr-1"></i> Verified Account
                        </span>
                    @endif
                    
                    @if($user->district || $user->state || $user->country)
                        <p class="text-sm text-gray-500 mt-2">
                            <i class="fas fa-map-marker-alt mr-1 text-red-500"></i>
                            @if($user->district){{ $user->district }}, @endif
                            @if($user->state){{ $user->state }}, @endif
                            @if($user->country){{ $user->country }}@endif
                            @if($user->pincode) - {{ $user->pincode }}@endif
                        </p>
                    @endif
                    
                    <p class="text-xs text-gray-400 mt-1">
                        <i class="far fa-calendar-alt mr-1"></i>
                        Member since {{ $user->created_at->format('F Y') }}
                    </p>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <div class="text-xl sm:text-2xl font-bold text-teal-600">{{ $postsCount }}</div>
                        <div class="text-xs sm:text-sm text-gray-600">Posts</div>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <div class="text-xl sm:text-2xl font-bold text-teal-600">0</div>
                        <div class="text-xs sm:text-sm text-gray-600">Connections</div>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <div class="text-xl sm:text-2xl font-bold text-teal-600">0</div>
                        <div class="text-xs sm:text-sm text-gray-600">Resources</div>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <div class="text-xl sm:text-2xl font-bold text-teal-600">0</div>
                        <div class="text-xs sm:text-sm text-gray-600">Views</div>
                    </div>
                </div>

                <!-- Profile Completion -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <div class="flex items-center justify-between mb-2">
                        <h4 class="font-bold text-gray-800">Profile Completion</h4>
                        <span class="text-teal-600 font-bold">{{ $completionPercentage }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 mb-4">
                        <div class="bg-teal-500 h-2.5 rounded-full" style="width: {{ $completionPercentage }}%"></div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-address-card text-teal-600 mr-2"></i> Contact
                        </h4>
                        <div class="space-y-3">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-envelope w-6 text-teal-600"></i>
                                <span class="ml-2">{{ $user->email }}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-phone-alt w-6 text-teal-600"></i>
                                <span class="ml-2">{{ $user->phone }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-star text-teal-600 mr-2"></i> Interests
                        </h4>
                        @if(count($interests) > 0)
                            <div class="flex flex-wrap gap-2">
                                @foreach($interests as $interest)
                                    <span class="bg-teal-100 text-teal-700 text-sm px-3 py-1 rounded-full">
                                        {{ trim($interest) }}
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-sm">No interests added yet</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Profile Modal -->
        <div id="editProfileModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
            <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full p-6">
                <h3 class="text-xl font-bold mb-4">Edit Profile</h3>
                <form>
                    <div class="space-y-4">
                        <input type="text" value="{{ $user->full_name }}" class="w-full p-2 border rounded">
                        <input type="text" value="{{ $user->occupation }}" class="w-full p-2 border rounded">
                        <button type="button" onclick="closeEditProfileModal()" class="bg-teal-600 text-white px-4 py-2 rounded">Close</button>
                    </div>
                </form>
            </div>
        </div>

    @else
        {{-- User not logged in --}}
        <div class="bg-white rounded-xl shadow-md p-8 text-center">
            <h2 class="text-2xl font-bold mb-4">Welcome to GBS Network</h2>
            <p class="mb-6">Please login to view your profile</p>
            <a href="{{ route('login') }}" class="bg-teal-600 text-white px-6 py-2 rounded-lg">Login</a>
        </div>
    @endif
</div>

<script>
function openEditProfileModal() {
    document.getElementById('editProfileModal').classList.remove('hidden');
    document.getElementById('editProfileModal').classList.add('flex');
}

function closeEditProfileModal() {
    document.getElementById('editProfileModal').classList.add('hidden');
    document.getElementById('editProfileModal').classList.remove('flex');
}
</script>