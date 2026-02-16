 <!-- Your existing profile tab code here -->
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