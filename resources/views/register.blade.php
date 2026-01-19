@extends('layout.user-layout')
@section('title')
    register page
@endsection

@section('content')
<div class="flex items-center justify-center min-h-screen px-4 py-10">
    <div class="bg-white rounded-xl border border-gray-200 w-full max-w-3xl shadow-sm">
        
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-center text-gray-800">Create Your Account</h2>
        </div>

        <form id="registrationForm" class="p-6 space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Full Name -->
                <div>
                    <label class="block text-gray-700 mb-2">Full Name *</label>
                    <input type="text" required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" 
                        placeholder="Enter your full name">
                </div>

                <!-- Mobile Number -->
                <div>
                    <label class="block text-gray-700 mb-2">Mobile Number *</label>
                    <input id="phone" name="phone" type="tel" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter mobile number">
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-gray-700 mb-2">Email ID *</label>
                    <input type="email" required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="example@email.com">
                </div>

                <!-- Country -->
                <div>
                    <label class="block text-gray-700 mb-2">Country *</label>
                    <select id="country" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Country</option>
                    </select>
                </div>

                <!-- State -->
                <div>
                    <label class="block text-gray-700 mb-2">State *</label>
                    <select id="state" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">Select State</option>
                    </select>
                </div>

                <!-- District -->
                <div>
                    <label class="block text-gray-700 mb-2">District *</label>
                    <select id="district" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">Select District</option>
                    </select>
                </div>

                <!-- PIN Code -->
                <div>
                    <label class="block text-gray-700 mb-2">PIN Code *</label>
                    <input type="text" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="6-digit PIN code">
                </div>
            </div>

            <!-- Category -->
            <div>
                <label class="block text-gray-700 mb-2">Select Circles *</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">

                    @foreach(['Doctors','IT Professionals','Lawyers','Real Estate','Accountants','Other'] as $category)
                    <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-blue-50">
                        <input type="radio" name="category" value="{{ strtolower(str_replace(' ','-',$category)) }}" class="mr-3">
                        <span>{{ $category }}</span>
                    </label>
                    @endforeach

                </div>
            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-lg font-medium hover:from-blue-700 hover:to-blue-800">
                Create Account
            </button>

            <p class="text-center text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" type="button" class="text-blue-600 font-medium hover:text-blue-700">Login here</a>
            </p>
        </form>
    </div>
</div>

<!-- Scripts -->
<script>
    // intl-tel-input
    const input = document.querySelector("#phone");

    const iti = window.intlTelInput(input, {
        initialCountry: "in",
        separateDialCode: true,
        preferredCountries: ["in", "us", "gb"],
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });

    document.getElementById("registrationForm").addEventListener("submit", function () {
        const fullNumber = iti.getNumber();
        input.value = fullNumber;
    });

    // Country → State → District data
    const data = {
        "India": {
            "Bihar": ["Patna", "Gaya", "Bhagalpur"],
            "Maharashtra": ["Mumbai", "Pune"],
            "Uttar Pradesh": ["Lucknow", "Kanpur"]
        },
        "United States": {
            "California": ["Los Angeles", "San Diego"],
            "New York": ["NYC", "Buffalo"]
        },
        "United Kingdom": {
            "England": ["London", "Manchester"],
            "Scotland": ["Glasgow", "Edinburgh"]
        }
    };

    const countrySelect = document.getElementById("country");
    const stateSelect = document.getElementById("state");
    const districtSelect = document.getElementById("district");

    Object.keys(data).forEach(country => {
        countrySelect.innerHTML += `<option value="${country}">${country}</option>`;
    });

    countrySelect.addEventListener("change", function () {
        stateSelect.innerHTML = `<option value="">Select State</option>`;
        districtSelect.innerHTML = `<option value="">Select District</option>`;
        if (this.value !== "") {
            Object.keys(data[this.value]).forEach(state => {
                stateSelect.innerHTML += `<option value="${state}">${state}</option>`;
            });
        }
    });

    stateSelect.addEventListener("change", function () {
        districtSelect.innerHTML = `<option value="">Select District</option>`;
        const country = countrySelect.value;
        const state = this.value;
        if (state !== "") {
            data[country][state].forEach(district => {
                districtSelect.innerHTML += `<option value="${district}">${district}</option>`;
            });
        }
    });
</script>
@endsection
