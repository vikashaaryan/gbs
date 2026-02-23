@extends('layout.user-layout')

@section('title', 'GBS - Feed Resource Panel Directory Profile')

@section('meta_description')
    GBS feed resource panel directory profile – view detailed profile information, resources, and activity in one place.
@endsection

@section('meta_keywords')
    GBS, feed, resource panel, directory, profile
@endsection

@section('content')
    <!-- Tabs Navigation - Fixed Sticky -->
    <div class="sticky md:top-20 top-17 -mt-8 md:-mt-15 z-50 bg-white sm:px-6 lg:px-1">
        <div class="flex overflow-x-auto py-3 md:px-32 px-4 gap-2 sm:gap-6 scrollbar-hide">
            <button onclick="switchTab('newsfeed')"
                class="tab-button active flex items-center gap-2 px-5 py-2.5 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition">
                <i class="fas fa-newspaper"></i>
                <span class="hidden md:inline">News Feed</span>
                <span class="md:hidden">Feed</span>
            </button>
            <button onclick="switchTab('resources')"
                class="tab-button flex items-center gap-2 px-5 py-2.5 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition">
                <i class="fas fa-book"></i> Resources
            </button>
            <button onclick="switchTab('directory')"
                class="tab-button flex items-center gap-2 px-5 py-2.5 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition">
                <i class="fas fa-address-book"></i> Directory
            </button>
            <button onclick="switchTab('profile')"
                class="tab-button flex items-center gap-2 px-5 py-2.5 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition">
                <i class="fas fa-user"></i> Profile
            </button>
        </div>
    </div>
    <!-- Tab Content -->
    <div class="px-4 sm:px-6 md:mx-12 lg:px-12 py-6 mb-8">
        <!-- News Feed Tab - Facebook Style -->
        <div id="newsfeed" class="tab-content">
            @include('user.partials.newsfeed-tab')

        </div>

        <!-- Resources Tab - Enhanced -->
        <!-- Resources Tab - Enhanced with Circle/SubCircle Navigation -->
        <div id="resources" class="tab-content hidden">
            @include('user.partials.resource-tab', ['circles' => $circles])
        </div>
        <!-- Directory Tab - Enhanced -->
        <div id="directory" class="tab-content hidden">
            @include('user.partials.directory-tab', [
                'users' => $users, // Changed from directoryUsers to users
                'allUsers' => $allUsers, // Changed from filterData to allUsers
                'circles' => $circles, // Changed from availableCircles to circles
            ])
        </div>

        <!-- Profile Tab -->
        <!-- Profile Tab -->
<div id="profile" class="tab-content hidden">
    @include('user.partials.profile-tab', [
        'user' => Auth::user(),
        'postsCount' => App\Models\Post::where('user_id', Auth::id())->count(),
        'circles' => $circles ?? []
    ])
</div>
    </div>

    <!-- Add this JavaScript section -->
    @push('scripts')
        <script>
            // Tab switching functionality
            function switchTab(tabName) {
                // Hide all tab contents
                document.querySelectorAll('.tab-content').forEach(tab => {
                    tab.classList.add('hidden');
                });

                // Remove active state from all tab buttons
                document.querySelectorAll('.tab-button').forEach(button => {
                    button.classList.remove('active', 'border-b-2', 'border-teal-600', 'text-teal-600', 'bg-teal-50');
                    button.classList.add('text-gray-700');
                });

                // Show selected tab content
                const activeTab = document.getElementById(tabName);
                if (activeTab) {
                    activeTab.classList.remove('hidden');
                }

                // Add active state to clicked button
                const activeButton = Array.from(document.querySelectorAll('.tab-button')).find(button =>
                    button.getAttribute('onclick').includes(tabName)
                );
                if (activeButton) {
                    activeButton.classList.add('active', 'border-b-2', 'border-teal-600', 'text-teal-600', 'bg-teal-50');
                    activeButton.classList.remove('text-gray-700');
                }

                // Update URL hash
                history.pushState(null, null, `#${tabName}`);
            }

            // Initialize on page load
            document.addEventListener('DOMContentLoaded', function() {
                // Check URL hash for initial tab
                const hash = window.location.hash.substring(1);
                const validTabs = ['newsfeed', 'resources', 'directory', 'profile'];

                if (validTabs.includes(hash)) {
                    switchTab(hash);
                } else {
                    // Default to newsfeed
                    switchTab('newsfeed');
                }

                // Initialize post form event listener
                initializePostForm();
            });

            // Initialize post form
            function initializePostForm() {
                const postForm = document.getElementById('postForm');
                if (!postForm) return;

                postForm.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const submitBtn = document.getElementById('postSubmitBtn');
                    const btnText = document.getElementById('postBtnText');
                    const btnSpinner = document.getElementById('postBtnSpinner');

                    // Disable button and show spinner
                    submitBtn.disabled = true;
                    btnText.classList.add('hidden');
                    btnSpinner.classList.remove('hidden');

                    try {
                        console.log('Submitting post...');
                        const response = await fetch(this.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: formData
                        });

                        const data = await response.json();
                        console.log('Post response:', data);

                        if (data.success) {
                            // Clear form
                            this.reset();
                            document.getElementById('mediaPreview').innerHTML = '';
                            document.getElementById('previewSection').classList.add('hidden');

                            // Show success message
                            showNotification(data.message || 'Post created successfully!', 'success');

                            // Reload page after 1 second to show new post
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        } else {
                            showNotification(data.message || 'Error creating post', 'error');
                        }
                    } catch (error) {
                        console.error('Post error:', error);
                        showNotification('Network error. Please try again.', 'error');
                    } finally {
                        // Re-enable button
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            btnText.classList.remove('hidden');
                            btnSpinner.classList.add('hidden');
                        }
                    }
                });
            }

            // File picker function
            function openFilePicker(type) {
                console.log('Opening file picker for:', type);
                switch (type) {
                    case 'image':
                        document.getElementById('imageInput').click();
                        break;
                    case 'video':
                        document.getElementById('videoInput').click();
                        break;
                    case 'audio':
                        document.getElementById('audioInput').click();
                        break;
                    case 'document':
                        document.getElementById('fileInput').click();
                        break;
                }
            }

            // Preview selected files
            document.addEventListener('DOMContentLoaded', function() {
                ['imageInput', 'videoInput', 'audioInput', 'fileInput'].forEach(inputId => {
                    const input = document.getElementById(inputId);
                    if (input) {
                        input.addEventListener('change', function(e) {
                            const previewSection = document.getElementById('previewSection');
                            const mediaPreview = document.getElementById('mediaPreview');

                            previewSection.classList.remove('hidden');

                            Array.from(this.files).forEach(file => {
                                const reader = new FileReader();

                                reader.onload = function(e) {
                                    const fileType = file.type.split('/')[0];
                                    let previewHTML = '';

                                    if (fileType === 'image') {
                                        previewHTML = `
                                    <div class="relative">
                                        <img src="${e.target.result}" 
                                             alt="Preview" 
                                             class="w-full h-32 object-cover rounded-lg">
                                        <span class="absolute top-1 right-1 bg-gray-800 bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                                            <i class="fas fa-image mr-1"></i>Image
                                        </span>
                                    </div>
                                `;
                                    } else if (fileType === 'video') {
                                        previewHTML = `
                                    <div class="relative">
                                        <video src="${e.target.result}" 
                                               class="w-full h-32 object-cover rounded-lg"></video>
                                        <span class="absolute top-1 right-1 bg-gray-800 bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                                            <i class="fas fa-video mr-1"></i>Video
                                        </span>
                                    </div>
                                `;
                                    } else if (fileType === 'audio') {
                                        previewHTML = `
                                    <div class="bg-purple-50 p-3 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-music text-purple-600 mr-3"></i>
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-gray-700">${file.name}</p>
                                                <p class="text-xs text-gray-500">Audio file</p>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                    } else {
                                        const icon = file.type.includes('pdf') ?
                                            'file-pdf' : 'file';
                                        previewHTML = `
                                    <div class="bg-blue-50 p-3 rounded-lg">
                                        <div class="flex items-center">
                                            <i class="fas fa-${icon} text-blue-600 mr-3"></i>
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-gray-700">${file.name}</p>
                                                <p class="text-xs text-gray-500">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                    }

                                    mediaPreview.innerHTML = previewHTML;
                                };

                                reader.readAsDataURL(file);
                            });
                        });
                    }
                });

                // Remove media button handler
                const removeMediaBtn = document.getElementById('removeMediaBtn');
                if (removeMediaBtn) {
                    removeMediaBtn.addEventListener('click', function() {
                        document.getElementById('imageInput').value = '';
                        document.getElementById('videoInput').value = '';
                        document.getElementById('audioInput').value = '';
                        document.getElementById('fileInput').value = '';

                        document.getElementById('mediaPreview').innerHTML = '';
                        document.getElementById('previewSection').classList.add('hidden');
                    });
                }
            });

            // Like/Unlike functionality
            async function toggleLike(postId) {
                try {
                    const response = await fetch(`/posts/${postId}/like`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                            'Content-Type': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const data = await response.json();

                    // Update UI
                    const likeBtn = document.querySelector(`.like-btn[data-post-id="${postId}"]`);
                    const likeText = likeBtn.querySelector('.like-text');
                    const likeIcon = likeBtn.querySelector('.far.fa-thumbs-up');
                    const likedIcon = likeBtn.querySelector('.fas.fa-thumbs-up');
                    const likesCount = document.querySelector(`.post-likes-count[data-post-id="${postId}"] .count`);

                    if (data.liked) {
                        likeText.textContent = 'Liked';
                        likeIcon.classList.add('hidden');
                        likedIcon.classList.remove('hidden');
                        showNotification('Post liked!', 'success');
                    } else {
                        likeText.textContent = 'Like';
                        likeIcon.classList.remove('hidden');
                        likedIcon.classList.add('hidden');
                    }

                    likesCount.textContent = data.likes_count;

                } catch (error) {
                    showNotification('Error updating like', 'error');
                }
            }

            // Show/hide comment box
            function showCommentBox(postId) {
                const commentsSection = document.getElementById(`comments-${postId}`);
                if (commentsSection) {
                    if (commentsSection.style.display === 'none') {
                        commentsSection.style.display = 'block';
                        commentsSection.scrollIntoView({
                            behavior: 'smooth'
                        });
                    } else {
                        commentsSection.style.display = 'none';
                    }
                }
            }

            // Comment form submission
            document.addEventListener('submit', async function(e) {
                if (e.target.classList.contains('add-comment-form')) {
                    e.preventDefault();
                    const postId = e.target.dataset.postId;
                    const commentInput = e.target.querySelector('input[name="comment"]');
                    const commentText = commentInput.value.trim();

                    if (commentText) {
                        try {
                            const response = await fetch(`/posts/${postId}/comment`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content'),
                                    'Content-Type': 'application/json',
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                body: JSON.stringify({
                                    comment: commentText
                                })
                            });

                            const data = await response.json();

                            if (data.success) {
                                // Clear input
                                commentInput.value = '';
                                showNotification('Comment added!', 'success');
                            }
                        } catch (error) {
                            showNotification('Error adding comment', 'error');
                        }
                    }
                }
            });

            // Delete post
            async function deletePost(postId) {
                if (!confirm('Are you sure you want to delete this post?')) return;

                try {
                    const response = await fetch(`/posts/${postId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        // Remove post from DOM
                        document.querySelector(`.post-item[data-post-id="${postId}"]`)?.remove();
                        showNotification('Post deleted successfully', 'success');
                    }
                } catch (error) {
                    showNotification('Error deleting post', 'error');
                }
            }

            // Notification function
            function showNotification(message, type = 'info') {
                const toast = document.createElement('div');
                toast.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white font-medium z-50 transition-all duration-300 ${
            type === 'success' ? 'bg-green-600' :
            type === 'error' ? 'bg-red-600' :
            'bg-blue-600'
        }`;
                toast.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'} mr-3"></i>
                <span>${message}</span>
            </div>
        `;
                document.body.appendChild(toast);

                setTimeout(() => {
                    toast.classList.add('opacity-0');
                    setTimeout(() => {
                        toast.remove();
                    }, 300);
                }, 3000);
            }

            // Post options menu toggle
            document.addEventListener('click', function(e) {
                if (e.target.closest('.post-options-btn')) {
                    const menu = e.target.closest('.post-options-btn').nextElementSibling;
                    menu.classList.toggle('hidden');
                } else {
                    document.querySelectorAll('.post-options-menu').forEach(menu => {
                        menu.classList.add('hidden');
                    });
                }
            });

            // Add CSRF token to all forms
            document.addEventListener('DOMContentLoaded', function() {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                document.querySelectorAll('form').forEach(form => {
                    if (!form.querySelector('input[name="_token"]')) {
                        const csrfInput = document.createElement('input');
                        csrfInput.type = 'hidden';
                        csrfInput.name = '_token';
                        csrfInput.value = csrfToken;
                        form.appendChild(csrfInput);
                    }
                });
            });
        </script>

        <!-- Copy the rest of your JavaScript code here -->
        <script>
            // Country, State, District API
            const countrySelect = document.getElementById("country");
            const stateSelect = document.getElementById("state");
            const districtSelect = document.getElementById("district");

            // Set default values from old input
            @if (old('country'))
                setTimeout(() => {
                    countrySelect.value = "{{ old('country') }}";
                    loadStates("{{ old('country') }}");

                    @if (old('state'))
                        setTimeout(() => {
                            stateSelect.value = "{{ old('state') }}";
                            loadDistricts("{{ old('country') }}", "{{ old('state') }}");

                            @if (old('district'))
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
                @if (!old('country'))
                    countrySelect.value = "India";
                    loadStates("India");
                @endif
            }

            // Load states of selected country
            async function loadStates(country) {
                const res = await fetch("https://countriesnow.space/api/v0.1/countries/states", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        country
                    })
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
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        country,
                        state
                    })
                });

                const result = await res.json();

                districtSelect.innerHTML = `<option value="">Select District</option>`;

                if (!result.data) return;

                result.data.forEach(city => {
                    districtSelect.innerHTML += `<option value="${city}">${city}</option>`;
                });
            }

            // On change events
            if (countrySelect) {
                countrySelect.addEventListener("change", function() {
                    loadStates(this.value);
                });
            }

            if (stateSelect) {
                stateSelect.addEventListener("change", function() {
                    if (countrySelect.value && this.value) {
                        loadDistricts(countrySelect.value, this.value);
                    }
                });
            }

            // Auto-run
            loadCountries();

            // Resource filtering function
            function filterResources(type) {
                const resources = document.querySelectorAll('.resource-card');
                const buttons = document.querySelectorAll('#resources .flex-wrap button');

                // Update button styles
                buttons.forEach(button => {
                    if (button.textContent.toLowerCase().includes(type) ||
                        (type === 'all' && button.textContent.includes('All Resources'))) {
                        button.classList.remove('bg-gray-100', 'text-gray-700');
                        button.classList.add('bg-blue-600', 'text-white');
                    } else {
                        button.classList.remove('bg-blue-600', 'text-white');
                        button.classList.add('bg-gray-100', 'text-gray-700');
                    }
                });

                // Show/hide resources
                resources.forEach(resource => {
                    if (type === 'all') {
                        resource.style.display = 'block';
                    } else {
                        if (resource.getAttribute('data-type') === type) {
                            resource.style.display = 'block';
                        } else {
                            resource.style.display = 'none';
                        }
                    }
                });
            }

            // Media playback functions (dummy versions)
            function playDummyAudio(audioId) {
                alert("Audio playback would start in a real application");
            }

            function playDummyVideo(videoId) {
                alert("Video playback would start in a real application");
            }

            function viewDummyPDF(pdfId) {
                alert("PDF viewer would open in a real application");
            }

            function viewDummyImages() {
                alert("Image gallery would open in a real application");
            }

            function showDummyEvent() {
                alert("Event creation form would open in a real application");
            }

            function submitHotelRequest() {
                const name = document.querySelector('#directory input[type="text"]')?.value;
                const mobile = document.querySelector('#directory input[type="tel"]')?.value;
                const terms = document.getElementById('terms')?.checked;

                if (!name || !mobile) {
                    alert('Please fill in all required fields.');
                    return;
                }

                if (!terms) {
                    alert('Please agree to the terms and conditions.');
                    return;
                }

                // Show success message
                alert("Request submitted successfully! Our team will contact you shortly.");
            }
        </script>
    @endpush

    <style>
        .tab-button.active {
            position: relative;
        }

        .tab-button.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(to right, #0d9488, #0891b2);
            border-radius: 3px 3px 0 0;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .hover-lift:hover {
            transform: translateY(-4px);
            transition: transform 0.3s ease;
        }
    </style>

    </div>
    <script>
        // Country, State, District API
        const countrySelect = document.getElementById("country");
        const stateSelect = document.getElementById("state");
        const districtSelect = document.getElementById("district");

        // Set default values from old input
        @if (old('country'))
            setTimeout(() => {
                countrySelect.value = "{{ old('country') }}";
                loadStates("{{ old('country') }}");

                @if (old('state'))
                    setTimeout(() => {
                        stateSelect.value = "{{ old('state') }}";
                        loadDistricts("{{ old('country') }}", "{{ old('state') }}");

                        @if (old('district'))
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
            @if (!old('country'))
                countrySelect.value = "India";
                loadStates("India");
            @endif
        }

        // Load states of selected country
        async function loadStates(country) {
            const res = await fetch("https://countriesnow.space/api/v0.1/countries/states", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    country
                })
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
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    country,
                    state
                })
            });

            const result = await res.json();

            districtSelect.innerHTML = `<option value="">Select District</option>`;

            if (!result.data) return;

            result.data.forEach(city => {
                districtSelect.innerHTML += `<option value="${city}">${city}</option>`;
            });
        }

        // On change events
        countrySelect.addEventListener("change", function() {
            loadStates(this.value);
        });

        stateSelect.addEventListener("change", function() {
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
                                subCircleSelect.innerHTML +=
                                    `<option value="${subCircle.id}">${subCircle.subcircle}</option>`;
                            });
                            subCircleSection.classList.remove('hidden');
                        } else {
                            subCircleSection.classList.add('hidden');
                        }

                        // Set old value if exists
                        @if (old('sub_circle_id'))
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
        @if (old('circle_id'))
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
    <script>
        // Tab switching functionality
        function switchTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
            });

            // Remove active state from all tab buttons
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('active', 'border-b-2', 'border-teal-600', 'text-teal-600', 'bg-teal-50');
                button.classList.add('text-gray-700');
            });

            // Show selected tab content
            const activeTab = document.getElementById(tabName);
            if (activeTab) {
                activeTab.classList.remove('hidden');
            }

            // Add active state to clicked button
            const activeButton = Array.from(document.querySelectorAll('.tab-button')).find(button =>
                button.getAttribute('onclick').includes(tabName)
            );
            if (activeButton) {
                activeButton.classList.add('active', 'border-b-2', 'border-teal-600', 'text-teal-600', 'bg-teal-50');
                activeButton.classList.remove('text-gray-700');
            }

            // Update URL hash for bookmarking (optional)
            history.pushState(null, null, `#${tabName}`);
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Check URL hash for initial tab
            const hash = window.location.hash.substring(1);
            const validTabs = ['newsfeed', 'resources', 'directory', 'profile'];

            if (validTabs.includes(hash)) {
                switchTab(hash);
            } else {
                // Default to newsfeed
                switchTab('newsfeed');
            }
        });

        // Resource filtering
        function filterResources(type) {
            const resources = document.querySelectorAll('.resource-card');
            const buttons = document.querySelectorAll('#resources .flex-wrap button');

            // Update button styles
            buttons.forEach(button => {
                if (button.textContent.toLowerCase().includes(type) ||
                    (type === 'all' && button.textContent.includes('All Resources'))) {
                    button.classList.remove('bg-gray-100', 'text-gray-700');
                    button.classList.add('bg-blue-600', 'text-white');
                } else {
                    button.classList.remove('bg-blue-600', 'text-white');
                    button.classList.add('bg-gray-100', 'text-gray-700');
                }
            });

            // Show/hide resources
            resources.forEach(resource => {
                if (type === 'all') {
                    resource.style.display = 'block';
                } else {
                    if (resource.getAttribute('data-type') === type) {
                        resource.style.display = 'block';
                    } else {
                        resource.style.display = 'none';
                    }
                }
            });
        }

        // Media playback functions
        function playDummyAudio(audioId) {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4';
            modal.innerHTML = `
                <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Now Playing</h3>
                        <button onclick="this.closest('.fixed').remove()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <div class="text-center mb-6">
                        <div class="w-24 h-24 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-music text-white text-3xl"></i>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-2">Leadership Podcast</h4>
                        <p class="text-gray-600">Episode 3: Team Management</p>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>2:45</span>
                            <div class="flex-1 mx-4">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-purple-600 h-2 rounded-full" style="width: 45%"></div>
                                </div>
                            </div>
                            <span>25:18</span>
                        </div>
                        <div class="flex items-center justify-center space-x-8">
                            <button class="text-gray-500 hover:text-purple-600 text-2xl">
                                <i class="fas fa-step-backward"></i>
                            </button>
                            <button class="w-14 h-14 bg-purple-600 text-white rounded-full flex items-center justify-center hover:bg-purple-700">
                                <i class="fas fa-play text-xl"></i>
                            </button>
                            <button class="text-gray-500 hover:text-purple-600 text-2xl">
                                <i class="fas fa-step-forward"></i>
                            </button>
                        </div>
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <button class="hover:text-purple-600">
                                <i class="fas fa-volume-up mr-1"></i> Volume
                            </button>
                            <button class="hover:text-purple-600">
                                <i class="fas fa-redo mr-1"></i> Repeat
                            </button>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            showNotification("Audio playback started");
        }

        function playDummyVideo(videoId) {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black flex items-center justify-center z-50';
            modal.innerHTML = `
                <div class="relative w-full max-w-4xl mx-4">
                    <button onclick="this.closest('.fixed').remove()" 
                            class="absolute -top-12 right-0 text-white hover:text-gray-300 z-10">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                    <div class="bg-black rounded-xl overflow-hidden">
                        <div class="relative pt-[56.25%]">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center">
                                    <div class="w-20 h-20 bg-white bg-opacity-90 rounded-full flex items-center justify-center mb-4 mx-auto">
                                        <i class="fas fa-play text-blue-600 text-3xl"></i>
                                    </div>
                                    <p class="text-white font-medium">Video Player (Demo)</p>
                                    <p class="text-gray-300 text-sm mt-2">This would play the video in a real application</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 bg-gray-900">
                            <h4 class="text-white font-bold text-lg mb-2">Digital Marketing Masterclass</h4>
                            <p class="text-gray-300 text-sm">Lesson 5: Social Media Strategy</p>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            showNotification("Video playback started");
        }

        function viewDummyPDF(pdfId) {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4';
            modal.innerHTML = `
                <div class="bg-white rounded-xl shadow-xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
                    <div class="flex justify-between items-center p-6 border-b border-gray-200">
                        <h3 class="text-xl font-bold text-gray-800">PDF Viewer (Demo)</h3>
                        <div class="flex items-center space-x-4">
                            <button class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-download"></i>
                            </button>
                            <button onclick="this.closest('.fixed').remove()" class="text-gray-400 hover:text-gray-600">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-6 overflow-auto max-h-[70vh]">
                        <div class="bg-gray-100 rounded-lg p-8 text-center">
                            <div class="w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-file-pdf text-red-600 text-4xl"></i>
                            </div>
                            <h4 class="text-xl font-bold text-gray-800 mb-2">Business Plan Template 2024.pdf</h4>
                            <p class="text-gray-600 mb-6">15 pages • 2.4 MB • PDF Document</p>
                            <div class="max-w-md mx-auto text-left space-y-3">
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span>Editable templates included</span>
                                </div>
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span>Financial projections sheets</span>
                                </div>
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                    <span>Market analysis framework</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 border-t border-gray-200">
                        <button onclick="this.closest('.fixed').remove()" 
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium">
                            <i class="fas fa-download mr-2"></i> Download PDF (Demo)
                        </button>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            showNotification("PDF viewer opened");
        }

        function viewDummyImages() {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4';
            modal.innerHTML = `
                <div class="bg-white rounded-xl shadow-xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
                    <div class="flex justify-between items-center p-6 border-b border-gray-200">
                        <h3 class="text-xl font-bold text-gray-800">Image Gallery (Demo)</h3>
                        <button onclick="this.closest('.fixed').remove()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <div class="p-6 overflow-auto max-h-[70vh]">
                        <div class="grid grid-cols-3 gap-4">
                            ${Array.from({length: 9}, (_, i) => ` <
                div class = "relative group" >
                <
                img src =
                "https://images.unsplash.com/photo-${1551288049 + i}?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80"
            alt = "Image ${i+1}"
            class = "w-full h-40 object-cover rounded-lg" >
            <
            div class =
            "absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 rounded-lg flex items-center justify-center opacity-0 group-hover:opacity-100" >
            <
            button class = "bg-white text-gray-800 px-4 py-2 rounded-lg font-medium" >
            <
            i class = "fas fa-download mr-1" > < /i> Download < /
            button > <
                /div> < /
            div >
                `).join('')}
                        </div>
                    </div>
                    <div class="p-6 border-t border-gray-200 text-center">
                        <p class="text-gray-600">150+ professional images available for download</p>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            showNotification("Image gallery opened");
        }
    </script>
    <script>
        let selectedFile = null;
        let currentFileType = null;

        function openFilePicker(type) {
            currentFileType = type;

            switch (type) {
                case 'image':
                    document.getElementById('imageInput').click();
                    break;
                case 'video':
                    document.getElementById('videoInput').click();
                    break;
                case 'audio':
                    document.getElementById('fileInput').click();
                    break;
                case 'document':
                    document.getElementById('fileInput').click();
                    break;
            }
        }

        // Image input change handler
        document.getElementById('imageInput').addEventListener('change', function(e) {
            handleFileSelect(e, 'image');
        });

        // Video input change handler
        document.getElementById('videoInput').addEventListener('change', function(e) {
            handleFileSelect(e, 'video');
        });

        // Document input change handler
        document.getElementById('fileInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            // Determine file type
            const fileName = file.name.toLowerCase();
            let type = 'document';

            if (fileName.endsWith('.mp3') || fileName.endsWith('.wav') || fileName.endsWith('.m4a')) {
                type = 'audio';
            } else if (fileName.endsWith('.pdf')) {
                type = 'pdf';
            }

            handleFileSelect(e, type);
        });

        function handleFileSelect(event, type) {
            const file = event.target.files[0];
            if (!file) return;

            selectedFile = {
                name: file.name,
                type: type,
                size: (file.size / (1024 * 1024)).toFixed(2) + ' MB'
            };

            showPreview(selectedFile);
        }

        function showPreview(file) {
            const previewSection = document.getElementById('previewSection');
            const mediaPreview = document.getElementById('mediaPreview');

            previewSection.classList.remove('hidden');

            if (file.type === 'image') {
                mediaPreview.innerHTML = `
            <div class="flex items-center space-x-3 p-2 bg-gray-50 rounded-lg">
                <div class="w-16 h-16 flex-shrink-0">
                    <div class="w-full h-full bg-gradient-to-br from-green-100 to-blue-100 rounded flex items-center justify-center">
                        <i class="fas fa-image text-green-500 text-xl"></i>
                    </div>
                </div>
                <div>
                    <p class="font-medium text-gray-800">${file.name}</p>
                    <p class="text-sm text-gray-500">Image • ${file.size}</p>
                </div>
            </div>
        `;
            } else if (file.type === 'video') {
                mediaPreview.innerHTML = `
            <div class="flex items-center space-x-3 p-2 bg-gray-50 rounded-lg">
                <div class="w-16 h-16 flex-shrink-0 bg-red-100 rounded flex items-center justify-center">
                    <i class="fas fa-video text-red-600 text-2xl"></i>
                </div>
                <div>
                    <p class="font-medium text-gray-800">${file.name}</p>
                    <p class="text-sm text-gray-500">Video • ${file.size}</p>
                </div>
            </div>
        `;
            } else if (file.type === 'audio') {
                mediaPreview.innerHTML = `
            <div class="flex items-center space-x-3 p-2 bg-gray-50 rounded-lg">
                <div class="w-16 h-16 flex-shrink-0 bg-purple-100 rounded flex items-center justify-center">
                    <i class="fas fa-music text-purple-600 text-2xl"></i>
                </div>
                <div>
                    <p class="font-medium text-gray-800">${file.name}</p>
                    <p class="text-sm text-gray-500">Audio • ${file.size}</p>
                </div>
            </div>
        `;
            } else if (file.type === 'pdf') {
                mediaPreview.innerHTML = `
            <div class="flex items-center space-x-3 p-2 bg-gray-50 rounded-lg">
                <div class="w-16 h-16 flex-shrink-0 bg-red-100 rounded flex items-center justify-center">
                    <i class="fas fa-file-pdf text-red-600 text-2xl"></i>
                </div>
                <div>
                    <p class="font-medium text-gray-800">${file.name}</p>
                    <p class="text-sm text-gray-500">PDF • ${file.size}</p>
                </div>
            </div>
        `;
            } else {
                mediaPreview.innerHTML = `
            <div class="flex items-center space-x-3 p-2 bg-gray-50 rounded-lg">
                <div class="w-16 h-16 flex-shrink-0 bg-blue-100 rounded flex items-center justify-center">
                    <i class="fas fa-file text-blue-600 text-2xl"></i>
                </div>
                <div>
                    <p class="font-medium text-gray-800">${file.name}</p>
                    <p class="text-sm text-gray-500">Document • ${file.size}</p>
                </div>
            </div>
        `;
            }
        }

        // Remove media button handler
        document.getElementById('removeMediaBtn').addEventListener('click', function() {
            selectedFile = null;
            currentFileType = null;

            document.getElementById('imageInput').value = '';
            document.getElementById('videoInput').value = '';
            document.getElementById('fileInput').value = '';

            document.getElementById('mediaPreview').innerHTML = '';
            document.getElementById('previewSection').classList.add('hidden');
        });

        function createDummyPost() {
            const content = document.getElementById('postContent').value.trim();

            if (!content && !selectedFile) {
                alert('Please add some content or a file to post.');
                return;
            }

            // Show dummy success message
            const messages = [
                "Your post has been shared successfully!",
                "Post created! It's now visible to your network.",
                "Success! Your update has been posted.",
                "Posted! Your content is now live."
            ];

            const randomMessage = messages[Math.floor(Math.random() * messages.length)];
            showNotification(randomMessage);

            // Reset form
            document.getElementById('postContent').value = '';
            if (selectedFile) {
                selectedFile = null;
                document.getElementById('imageInput').value = '';
                document.getElementById('videoInput').value = '';
                document.getElementById('fileInput').value = '';
                document.getElementById('mediaPreview').innerHTML = '';
                document.getElementById('previewSection').classList.add('hidden');
            }
        }

        function showDummyEvent() {
            const eventModal = document.createElement('div');
            eventModal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4';
            eventModal.innerHTML = `
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Create Event (Demo)</h3>
                <button onclick="this.closest('.fixed').remove()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div class="space-y-4">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                        <p class="text-blue-700 text-sm">This is a demo. In a real application, you would see a full event creation form here.</p>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Event Title</label>
                    <input type="text" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Team Meeting" value="Team Meeting">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                    <input type="text" class="w-full p-2 border border-gray-300 rounded-lg" value="Tomorrow, 2:00 PM">
                </div>
                <div class="pt-4 flex justify-end space-x-3">
                    <button onclick="this.closest('.fixed').remove()" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                        Cancel
                    </button>
                    <button onclick="createDummyEvent(this)" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg">
                        Create Event
                    </button>
                </div>
            </div>
        </div>
    `;
            document.body.appendChild(eventModal);
        }

        function createDummyEvent(button) {
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating...';

            setTimeout(() => {
                showNotification("Event created successfully! (Demo)");
                document.querySelector('.fixed').remove();
            }, 1500);
        }

        function showNotification(message) {
            // Create notification element
            const notification = document.createElement('div');
            notification.className =
                'fixed top-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-slide-in';
            notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-3"></i>
            <span>${message}</span>
        </div>
    `;

            document.body.appendChild(notification);

            // Remove after 3 seconds
            setTimeout(() => {
                notification.classList.add('animate-fade-out');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 3000);
        }

        function submitHotelRequest() {
            const name = document.querySelector('#directory input[type="text"]').value;
            const mobile = document.querySelector('#directory input[type="tel"]').value;
            const terms = document.getElementById('terms').checked;

            if (!name || !mobile) {
                alert('Please fill in all required fields.');
                return;
            }

            if (!terms) {
                alert('Please agree to the terms and conditions.');
                return;
            }

            // Show success message
            const button = document.querySelector('#directory button[onclick="submitHotelRequest()"]');
            const originalText = button.innerHTML;

            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
            button.disabled = true;

            setTimeout(() => {
                // Create success modal
                const modal = document.createElement('div');
                modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4';
                modal.innerHTML = `
                    <div class="bg-white rounded-xl shadow-xl max-w-md w-full p-6">
                        <div class="flex flex-col items-center text-center">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-check text-green-600 text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Request Submitted Successfully!</h3>
                            <p class="text-gray-600 mb-4">
                                We have received your request. Our team will contact you shortly with the best hotel deals.
                            </p>
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4 w-full">
                                <p class="text-sm text-blue-700">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    You will receive a confirmation SMS on ${mobile} within 5 minutes.
                                </p>
                            </div>
                            <button onclick="this.closest('.fixed').remove()" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-6 rounded-lg">
                                Close
                            </button>
                        </div>
                    </div>
                `;

                document.body.appendChild(modal);

                // Reset button
                button.innerHTML = originalText;
                button.disabled = false;

                // Reset form
                document.querySelector('#directory input[type="text"]').value = '';
                document.querySelector('#directory input[type="tel"]').value = '';
                document.getElementById('terms').checked = false;

            }, 1500);
        }

        // Add CSS animations
        const style = document.createElement('style');
        style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes fadeOut {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
        }
    }
    
    .animate-slide-in {
        animation: slideIn 0.3s ease-out forwards;
    }
    
    .animate-fade-out {
        animation: fadeOut 0.3s ease-out forwards;
    }

    .resource-card {
        transition: all 0.3s ease;
    }

    .resource-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
`;
        document.head.appendChild(style);

        function toggleMobileFilters() {
            const mobileFilters = document.getElementById('mobileFilters');
            const button = document.querySelector('[onclick="toggleMobileFilters()"]');

            if (mobileFilters.classList.contains('hidden')) {
                mobileFilters.classList.remove('hidden');
                button.innerHTML = `
            <i class="fas fa-filter"></i>
            <span>Show Less Filters</span>
            <i class="fas fa-chevron-up text-sm"></i>
        `;
            } else {
                mobileFilters.classList.add('hidden');
                button.innerHTML = `
            <i class="fas fa-filter"></i>
            <span>Show More Filters</span>
            <i class="fas fa-chevron-down text-sm"></i>
        `;
            }
        }
    </script>
    <style>
        .tab-button.active {
            position: relative;
        }

        .tab-button.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(to right, #0d9488, #0891b2);
            border-radius: 3px 3px 0 0;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .hover-lift:hover {
            transform: translateY(-4px);
            transition: transform 0.3s ease;
        }
    </style>
@endsection
