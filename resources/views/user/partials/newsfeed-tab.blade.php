  <div class="max-w-2xl mx-auto">
                <!-- Create Post Box -->
                @auth
                    <div class="bg-white rounded-xl shadow-md p-4 mb-6 border border-gray-200">
                        <form id="postForm" enctype="multipart/form-data" action="{{ route('posts.store') }}" method="POST">
                            @csrf
                            <div class="flex items-center mb-4">
                                <div class="w-10 h-10 rounded-full overflow-hidden mr-3 flex-shrink-0">
                                    @php
                                        $user = auth()->user();
                                    @endphp
                                    @if ($user && $user->photo)
                                        <img src="{{ Storage::url($user->photo) }}" alt="{{ $user->full_name }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div
                                            class="w-full h-full bg-gradient-to-r from-blue-500 to-cyan-500 flex items-center justify-center">
                                            <span class="text-white font-semibold text-sm">
                                                {{ $user ? strtoupper(substr($user->full_name, 0, 1)) : 'G' }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                <textarea name="description" id="postContent" class="flex-1 p-3 border border-gray-300 rounded-lg text-sm sm:text-base"
                                    rows="2" placeholder="What's on your mind, {{ $user ? $user->full_name : 'Guest' }}?"></textarea>
                            </div>

                            <!-- Preview Section -->
                            <div id="previewSection" class="mb-3 hidden">
                                <div id="mediaPreview" class="grid grid-cols-2 gap-2 mb-2"></div>
                                <button type="button" id="removeMediaBtn" class="text-red-600 text-sm hover:text-red-800">
                                    <i class="fas fa-times mr-1"></i>Remove all files
                                </button>
                            </div>

                            <div class="border-t pt-3">
                                <!-- Hidden File Inputs -->
                                <input type="file" id="imageInput" name="photo" accept="image/*" class="hidden">
                                <input type="file" id="videoInput" name="video" accept="video/*" class="hidden">
                                <input type="file" id="audioInput" name="audio" accept="audio/*" class="hidden">
                                <input type="file" id="fileInput" name="document" accept=".pdf,.doc,.docx,.txt"
                                    class="hidden">

                                <div class="flex flex-wrap gap-2">
                                    <button type="button" onclick="openFilePicker('image')"
                                        class="flex items-center gap-2 px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors touch-target">
                                        <i class="fas fa-image text-green-600"></i>
                                        <span class="text-sm font-medium">Photo</span>
                                    </button>
                                    <button type="button" onclick="openFilePicker('video')"
                                        class="flex items-center gap-2 px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors touch-target">
                                        <i class="fas fa-video text-red-600"></i>
                                        <span class="text-sm font-medium">Video</span>
                                    </button>
                                    <button type="button" onclick="openFilePicker('audio')"
                                        class="flex items-center gap-2 px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors touch-target">
                                        <i class="fas fa-music text-purple-600"></i>
                                        <span class="text-sm font-medium">Audio</span>
                                    </button>
                                    <button type="button" onclick="openFilePicker('document')"
                                        class="flex items-center gap-2 px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors touch-target">
                                        <i class="fas fa-file text-blue-600"></i>
                                        <span class="text-sm font-medium">Document</span>
                                    </button>
                                </div>

                                <!-- Submit Button -->
                                <div class="mt-4 flex justify-end">
                                    <button type="submit" id="postSubmitBtn"
                                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                        <span id="postBtnText">Post</span>
                                        <span id="postBtnSpinner" class="hidden">
                                            <i class="fas fa-spinner fa-spin mr-1"></i> Posting...
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @else
                    <!-- Login Prompt -->
                    <div class="bg-white rounded-xl shadow-md p-6 mb-6 border border-gray-200 text-center">
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-sign-in-alt text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Login to Post</h3>
                        <p class="text-gray-600 mb-4">Please login to create posts and interact with others.</p>
                        <a href="{{ route('login') }}"
                            class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-6 rounded-lg transition-colors">
                            <i class="fas fa-sign-in-alt mr-2"></i> Login Now
                        </a>
                    </div>
                @endauth

                <!-- Posts Feed -->
                <div id="postsContainer">
                    @php
                        // Safe check for posts variable
                        $hasPosts =
                            isset($posts) &&
                            $posts instanceof Illuminate\Pagination\LengthAwarePaginator &&
                            $posts->count() > 0;
                    @endphp

                    @if ($hasPosts)
                        @foreach ($posts as $post)
                            @include('user.partials.post-item', ['post' => $post])
                        @endforeach

                        <!-- Pagination -->
                        @if ($posts->hasPages())
                            <div class="mt-6">
                                {{ $posts->links() }}
                            </div>
                        @endif
                    @else
                        <div class="bg-white rounded-xl shadow-md p-8 text-center border border-gray-200">
                            <i class="fas fa-newspaper text-gray-300 text-4xl mb-4"></i>
                            <h3 class="text-xl font-semibold text-gray-700 mb-2">
                                @auth
                                    No posts yet
                                @else
                                    Welcome to GBS
                                @endauth
                            </h3>
                            <p class="text-gray-500 mb-4">
                                @auth
                                    Be the first to share something in your circle!
                                @else
                                    Please login to see posts from your network
                                @endauth
                            </p>
                            @guest
                                <a href="{{ route('login') }}"
                                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition-colors">
                                    <i class="fas fa-sign-in-alt mr-2"></i> Login Now
                                </a>
                            @endguest
                        </div>
                    @endif
                </div>
            </div>