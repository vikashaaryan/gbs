  <!-- Your existing directory tab code here -->
            <div class="max-w-6xl mx-auto">

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