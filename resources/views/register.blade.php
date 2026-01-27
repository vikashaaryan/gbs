@extends('layout.user-layout')

@section('title', 'Register | GBS')

@section('meta_description')
Register for a GBS account to access exclusive services, connect with professionals, and explore personalized resources.
@endsection

@section('meta_keywords')
GBS register, create account, sign up, join GBS, registration, new account
@endsection

@section('content')
<div class="flex items-center justify-center min-h-screen px-4">
    <div class="bg-white rounded-xl border border-gray-200 w-full max-w-3xl shadow-sm">
        
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-center text-gray-800">Create Your Account</h2>
        </div>

        <form id="registrationForm" action="{{ route('register.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Full Name -->
                <div>
                    <label class="block text-gray-700 mb-2">Full Name *</label>
                    <input type="text" name="full_name" value="{{ old('full_name') }}" required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('full_name') border-red-500 @enderror" 
                        placeholder="Enter your full name">
                    @error('full_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Mobile Number -->
                <div>
                    <label class="block text-gray-700 mb-2">Mobile Number *</label>
                    <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('phone') border-red-500 @enderror"
                        placeholder="Enter mobile number">
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-gray-700 mb-2">Email ID *</label>
                    <input type="email" name="email" value="{{ old('email') }}" required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror"
                        placeholder="example@email.com">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Country -->
                <div>
                    <label class="block text-gray-700 mb-2">Country *</label>
                    <select id="country" name="country" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('country') border-red-500 @enderror">
                        <option value="">Select Country</option>
                    </select>
                    @error('country')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- State -->
                <div>
                    <label class="block text-gray-700 mb-2">State *</label>
                    <select id="state" name="state" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('state') border-red-500 @enderror">
                        <option value="">Select State</option>
                    </select>
                    @error('state')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- District -->
                <div>
                    <label class="block text-gray-700 mb-2">District *</label>
                    <select id="district" name="district" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('district') border-red-500 @enderror">
                        <option value="">Select District</option>
                    </select>
                    @error('district')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- PIN Code -->
                <div>
                    <label class="block text-gray-700 mb-2">PIN Code *</label>
                    <input type="text" name="pincode" value="{{ old('pincode') }}" required maxlength="6"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('pincode') border-red-500 @enderror"
                        placeholder="6-digit PIN code">
                    @error('pincode')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-gray-700 mb-2">Password *</label>
                    <input type="password" id="password" name="password" required minlength="8"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                        placeholder="Enter password (min. 8 characters)">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-gray-700 mb-2">Confirm Password *</label>
                    <input type="password" name="password_confirmation" required minlength="8"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Confirm password">
                </div>

                <!-- Select Occupation -->
                <div>
                    <label class="block text-gray-700 mb-2">Select Occupation *</label>
                    <select id="occupation" name="occupation" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('occupation') border-red-500 @enderror">
                        <option value="">Select Occupation</option>
                        <option value="business-owner" {{ old('occupation') == 'business-owner' ? 'selected' : '' }}>Business Owner</option>
                        <option value="c-level" {{ old('occupation') == 'c-level' ? 'selected' : '' }}>C-Level</option>
                        <option value="house-wife" {{ old('occupation') == 'house-wife' ? 'selected' : '' }}>House Wife</option>
                        <option value="professional" {{ old('occupation') == 'professional' ? 'selected' : '' }}>Professional</option>
                        <option value="retired" {{ old('occupation') == 'retired' ? 'selected' : '' }}>Retired</option>
                        <option value="salaried" {{ old('occupation') == 'salaried' ? 'selected' : '' }}>Salaried</option>
                        <option value="student" {{ old('occupation') == 'student' ? 'selected' : '' }}>Student</option>
                        <option value="unemployed" {{ old('occupation') == 'unemployed' ? 'selected' : '' }}>Unemployed</option>
                    </select>
                    @error('occupation')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Select Interest Section -->
            <div>
                <label class="block text-gray-700 mb-3">Select Interest *</label>
                <div class="space-y-2">
                    <!-- Row 1 -->
                    <div class="flex flex-wrap gap-2">
                        <label class="flex items-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="checkbox" name="interests[]" value="beauty" {{ is_array(old('interests')) && in_array('beauty', old('interests')) ? 'checked' : '' }} class="mr-2 rounded">
                            <span>Beauty</span>
                        </label>
                        
                        <label class="flex items-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="checkbox" name="interests[]" value="business-industry" {{ is_array(old('interests')) && in_array('business-industry', old('interests')) ? 'checked' : '' }} class="mr-2 rounded">
                            <span>Business & Industry</span>
                        </label>
                        
                        <label class="flex items-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="checkbox" name="interests[]" value="cinema-entertainment" {{ is_array(old('interests')) && in_array('cinema-entertainment', old('interests')) ? 'checked' : '' }} class="mr-2 rounded">
                            <span>Cinema & Entertainment</span>
                        </label>
                    </div>
                    
                    <!-- Row 2 -->
                    <div class="flex flex-wrap gap-2">
                        <label class="flex items-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="checkbox" name="interests[]" value="fitness-wellness" {{ is_array(old('interests')) && in_array('fitness-wellness', old('interests')) ? 'checked' : '' }} class="mr-2 rounded">
                            <span>Fitness & Wellness</span>
                        </label>
                        
                        <label class="flex items-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="checkbox" name="interests[]" value="food-drink" {{ is_array(old('interests')) && in_array('food-drink', old('interests')) ? 'checked' : '' }} class="mr-2 rounded">
                            <span>Food & Drink</span>
                        </label>
                        
                        <label class="flex items-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="checkbox" name="interests[]" value="gadgets" {{ is_array(old('interests')) && in_array('gadgets', old('interests')) ? 'checked' : '' }} class="mr-2 rounded">
                            <span>Gadgets</span>
                        </label>
                    </div>
                    
                    <!-- Row 3 -->
                    <div class="flex flex-wrap gap-2">
                        <label class="flex items-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="checkbox" name="interests[]" value="news" {{ is_array(old('interests')) && in_array('news', old('interests')) ? 'checked' : '' }} class="mr-2 rounded">
                            <span>News</span>
                        </label>
                        
                        <label class="flex items-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="checkbox" name="interests[]" value="shopping-fashion" {{ is_array(old('interests')) && in_array('shopping-fashion', old('interests')) ? 'checked' : '' }} class="mr-2 rounded">
                            <span>Shopping & Fashion</span>
                        </label>
                        
                        <label class="flex items-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="checkbox" name="interests[]" value="sports" {{ is_array(old('interests')) && in_array('sports', old('interests')) ? 'checked' : '' }} class="mr-2 rounded">
                            <span>Sports</span>
                        </label>
                    </div>
                    
                    <!-- Row 4 -->
                    <div class="flex flex-wrap gap-2">
                        <label class="flex items-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="checkbox" name="interests[]" value="technology" {{ is_array(old('interests')) && in_array('technology', old('interests')) ? 'checked' : '' }} class="mr-2 rounded">
                            <span>Technology</span>
                        </label>
                        
                        <label class="flex items-center px-4 py-2 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="checkbox" name="interests[]" value="tourism" {{ is_array(old('interests')) && in_array('tourism', old('interests')) ? 'checked' : '' }} class="mr-2 rounded">
                            <span>Tourism</span>
                        </label>
                    </div>
                </div>
                @error('interests')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Dynamic Circles and Sub-Circles -->
            <div>
                <label class="block text-gray-700 mb-2">Select Circle *</label>
                <select id="circle_id" name="circle_id" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('circle_id') border-red-500 @enderror">
                    <option value="">Select Circle</option>
                    @foreach($circles as $circle)
                        <option value="{{ $circle->id }}" {{ old('circle_id') == $circle->id ? 'selected' : '' }}>
                            {{ $circle->title }}
                        </option>
                    @endforeach
                </select>
                @error('circle_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Sub-Circle Selection (Dynamic) -->
            <div id="subCircleSection" class="hidden">
                <label class="block text-gray-700 mb-2">Select Sub-Circle *</label>
                <select id="sub_circle_id" name="sub_circle_id"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('sub_circle_id') border-red-500 @enderror">
                    <option value="">Select Sub-Circle</option>
                </select>
                @error('sub_circle_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <!-- Submit -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-lg font-medium hover:from-blue-700 hover:to-blue-800 transition-colors">
                Create Account
            </button>

            <p class="text-center text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:text-blue-700">Login here</a>
            </p>
        </form>
    </div>
</div>

<!-- Phone Input Script -->
<script>
    const input = document.querySelector("#phone");

    const iti = window.intlTelInput(input, {
        initialCountry: "in",
        separateDialCode: true,
        preferredCountries: ["in", "us", "gb"],
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });

    document.getElementById("registrationForm").addEventListener("submit", function () {
        input.value = iti.getNumber(); 
    });
</script>

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

<style>
    /* Style for selected checkboxes */
    label:has(input[type="checkbox"]:checked) {
        background-color: #eff6ff;
        border-color: #3b82f6;
        color: #1e40af;
    }

    .hidden {
        display: none;
    }
</style>

@endsection