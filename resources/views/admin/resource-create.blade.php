@extends('layout.admin-layout')

@section('title', 'Create New Resource')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Create New Resource</h1>
            <p class="mt-1 text-sm text-gray-600">Add a new learning resource to your platform</p>
        </div>
        <a href="{{ route('admin.manage-resources') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Resources
        </a>
    </div>

    <!-- Error Alerts -->
    @if($errors->any())
    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    <!-- Main Form -->
    <form action="{{ route('admin.resources.store') }}" method="POST" enctype="multipart/form-data" id="resourceForm" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Main Content (2/3 width) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-indigo-50 to-blue-50 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h2 class="ml-3 text-lg font-semibold text-gray-900">Basic Information</h2>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700">
                                    Resource Title <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="text" 
                                           name="title" 
                                           id="title" 
                                           value="{{ old('title') }}"
                                           class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 @error('title') border-red-500 @enderror"
                                           placeholder="e.g., Introduction to Web Development"
                                           required>
                                </div>
                                @error('title')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">
                                    Description
                                </label>
                                <div class="mt-1">
                                    <textarea name="description" 
                                              id="description" 
                                              rows="5"
                                              class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200"
                                              placeholder="Provide a detailed description of what this resource covers...">{{ old('description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Category Assignment Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-green-50 to-emerald-50 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-5-5A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </div>
                            <h2 class="ml-3 text-lg font-semibold text-gray-900">Category Assignment</h2>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="circle_id" class="block text-sm font-medium text-gray-700">
                                    Circle <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-1">
                                    <select name="circle_id" 
                                            id="circle_id" 
                                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 @error('circle_id') border-red-500 @enderror"
                                            required>
                                        <option value="">Select a circle</option>
                                        @foreach($circles as $circle)
                                            <option value="{{ $circle->id }}" {{ old('circle_id') == $circle->id ? 'selected' : '' }}>
                                                {{ $circle->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('circle_id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="sub_circle_id" class="block text-sm font-medium text-gray-700">
                                    Sub Circle
                                </label>
                                <div class="mt-1">
                                    <select name="sub_circle_id" 
                                            id="sub_circle_id" 
                                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                        <option value="">Select a sub circle (optional)</option>
                                        @foreach($subCircles as $subCircle)
                                            <option value="{{ $subCircle->id }}" 
                                                    data-circle="{{ $subCircle->circle_id }}"
                                                    {{ old('sub_circle_id') == $subCircle->id ? 'selected' : '' }}>
                                                {{ $subCircle->subcircle }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('sub_circle_id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="category_id" class="block text-sm font-medium text-gray-700">
                                    Resource Category <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-1">
                                    <select name="category_id" 
                                            id="category_id" 
                                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 @error('category_id') border-red-500 @enderror"
                                            required>
                                        <option value="">Select a category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Resource Type & File Upload Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-pink-50 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h2 class="ml-3 text-lg font-semibold text-gray-900">Resource Type & Upload</h2>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700">
                                    Resource Type <span class="text-red-500">*</span>
                                </label>
                                <div class="mt-1">
                                    <select name="type" 
                                            id="type" 
                                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200 @error('type') border-red-500 @enderror"
                                            required>
                                        <option value="">Select type</option>
                                        <option value="audio" {{ old('type') == 'audio' ? 'selected' : '' }}>🎵 Audio</option>
                                        <option value="video" {{ old('type') == 'video' ? 'selected' : '' }}>🎥 Video</option>
                                        <option value="pdf" {{ old('type') == 'pdf' ? 'selected' : '' }}>📄 PDF</option>
                                        <option value="image" {{ old('type') == 'image' ? 'selected' : '' }}>🖼️ Image</option>
                                        <option value="document" {{ old('type') == 'document' ? 'selected' : '' }}>📝 Document</option>
                                        <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>📦 Other</option>
                                    </select>
                                </div>
                                @error('type')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="file_size" class="block text-sm font-medium text-gray-700">
                                    File Size
                                </label>
                                <input type="text" 
                                       name="file_size" 
                                       id="file_size" 
                                       value="{{ old('file_size') }}"
                                       class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                       placeholder="e.g., 10 MB">
                            </div>
                        </div>

                        <!-- File Upload Area -->
                        <div class="mt-6">
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-indigo-500 transition-colors duration-200" id="fileUploadArea">
                                <div class="text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                    <div class="mt-4 flex text-sm text-gray-600">
                                        <label for="file_upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Upload a file</span>
                                            <input id="file_upload" name="file" type="file" class="sr-only">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">
                                        Max file size: 100MB
                                    </p>
                                </div>
                            </div>
                            @error('file')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- External URL -->
                        <div class="mt-6">
                            <label for="external_url" class="block text-sm font-medium text-gray-700">
                                Or External URL
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                    </svg>
                                </div>
                                <input type="url" 
                                       name="external_url" 
                                       id="external_url" 
                                       value="{{ old('external_url') }}"
                                       class="block w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200"
                                       placeholder="https://example.com/resource">
                            </div>
                        </div>

                        <!-- Thumbnail Upload -->
                        <div class="mt-6">
                            <label for="thumbnail" class="block text-sm font-medium text-gray-700">
                                Thumbnail Image
                            </label>
                            <div class="mt-1 flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <div id="thumbnailPreview" class="hidden w-24 h-24 rounded-lg border-2 border-gray-300 overflow-hidden bg-gray-50">
                                        <img src="" alt="Thumbnail preview" class="w-full h-full object-cover">
                                    </div>
                                </div>
                                <label class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <span>Choose image</span>
                                    <input type="file" name="thumbnail" id="thumbnail" class="sr-only" accept="image/*">
                                </label>
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Max size: 5MB</p>
                        </div>
                    </div>
                </div>

                <!-- Metadata Information Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-amber-50 to-orange-50 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                </svg>
                            </div>
                            <h2 class="ml-3 text-lg font-semibold text-gray-900">Resource Metadata</h2>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="published_date" class="block text-sm font-medium text-gray-700">
                                    Published Date
                                </label>
                                <input type="date" 
                                       name="published_date" 
                                       id="published_date" 
                                       value="{{ old('published_date') }}"
                                       class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                            </div>

                            <div>
                                <label for="language" class="block text-sm font-medium text-gray-700">
                                    Language
                                </label>
                                <select name="language" 
                                        id="language" 
                                        class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors duration-200">
                                    <option value="English" selected>English</option>
                                    <option value="Hindi">हिन्दी (Hindi)</option>
                                    <option value="Spanish">Español (Spanish)</option>
                                    <option value="French">Français (French)</option>
                                    <option value="German">Deutsch (German)</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Sidebar (1/3 width) - Removed extra fields -->
            <div class="space-y-6">
                <!-- Helper Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 bg-gradient-to-r from-blue-50 to-cyan-50 border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h2 class="ml-3 text-lg font-semibold text-gray-900">Tips</h2>
                        </div>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3 text-sm text-gray-600">
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Choose a descriptive title</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Add a thumbnail for better visibility</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Select the correct category</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
            <button type="button" 
                    onclick="window.history.back()" 
                    class="px-6 py-3 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                Cancel
            </button>
            <button type="submit" 
                    class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-blue-600 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white hover:from-indigo-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                </svg>
                Create Resource
            </button>
        </div>
    </form>
</div>

@push('styles')
<style>
    .file-upload-highlight {
        border-color: #4f46e5;
        background-color: #eef2ff;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Dynamic Subcircle Filtering
        const circleSelect = document.getElementById('circle_id');
        const subCircleSelect = document.getElementById('sub_circle_id');
        const allSubCircles = Array.from(subCircleSelect.options);
        
        function filterSubCircles() {
            const selectedCircle = circleSelect.value;
            subCircleSelect.innerHTML = '<option value="">Select a sub circle (optional)</option>';
            
            allSubCircles.forEach(option => {
                if (option.value === '') return;
                if (option.dataset.circle === selectedCircle) {
                    subCircleSelect.appendChild(option.cloneNode(true));
                }
            });
        }
        
        if (circleSelect) {
            circleSelect.addEventListener('change', filterSubCircles);
            // Trigger on page load if circle is pre-selected
            if (circleSelect.value) {
                filterSubCircles();
                if (subCircleSelect) {
                    subCircleSelect.value = '{{ old('sub_circle_id') }}';
                }
            }
        }

        // Thumbnail Preview
        const thumbnailInput = document.getElementById('thumbnail');
        const thumbnailPreview = document.getElementById('thumbnailPreview');
        const previewImage = thumbnailPreview?.querySelector('img');

        if (thumbnailInput) {
            thumbnailInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file && thumbnailPreview && previewImage) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        thumbnailPreview.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // File Upload Area Drag & Drop
        const fileUploadArea = document.getElementById('fileUploadArea');
        const fileInput = document.getElementById('file_upload');

        if (fileUploadArea && fileInput) {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                fileUploadArea.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                fileUploadArea.addEventListener(eventName, () => {
                    fileUploadArea.classList.add('file-upload-highlight');
                });
            });

            ['dragleave', 'drop'].forEach(eventName => {
                fileUploadArea.addEventListener(eventName, () => {
                    fileUploadArea.classList.remove('file-upload-highlight');
                });
            });

            fileUploadArea.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                const files = dt.files;
                fileInput.files = files;
                
                // Show filename
                if (files.length > 0) {
                    const fileName = files[0].name;
                    const fileNameElement = fileUploadArea.querySelector('p.text-xs');
                    if (fileNameElement) {
                        fileNameElement.innerHTML = `Selected: ${fileName}`;
                    }
                }
            });

            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    const fileName = this.files[0].name;
                    const fileNameElement = fileUploadArea.querySelector('p.text-xs');
                    if (fileNameElement) {
                        fileNameElement.innerHTML = `Selected: ${fileName}`;
                    }
                }
            });
        }
    });
</script>
@endpush
@endsection