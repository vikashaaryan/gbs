@extends('layout.admin-layout')

@section('title', 'Manage Resources')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
        <div>
            <div class="flex items-center gap-3">
                <div class="p-2 bg-indigo-100 rounded-lg">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Manage Resources</h1>
                    <nav class="flex mt-1 text-sm text-gray-500">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 transition-colors">Dashboard</a>
                        <span class="mx-2">/</span>
                        <span class="text-gray-700 font-medium">Resources</span>
                    </nav>
                </div>
            </div>
        </div>
        <a href="{{ route('admin.resources.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-blue-600 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white hover:from-indigo-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Create New Resource
        </a>
    </div>

    <!-- Statistics Card -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Resources Card -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium uppercase tracking-wider">Total Resources</p>
                        <p class="text-3xl font-bold text-white mt-2">{{ $totalResources ?? 0 }}</p>
                        <div class="flex items-center mt-2">
                            <span class="text-blue-100 text-sm">+{{ $newResourcesToday ?? 0 }} today</span>
                        </div>
                    </div>
                    <div class="p-3 bg-white bg-opacity-30 rounded-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Simple Filters Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8 overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-white rounded-lg shadow-sm">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">Filter Resources</h3>
                </div>
            </div>
        </div>
        <div class="p-6">
            <form method="GET" action="{{ route('admin.manage-resources') }}" id="filterForm">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div class="lg:col-span-2">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                        <div class="flex">
                            <input type="text" 
                                   name="search" 
                                   id="search" 
                                   value="{{ request('search') }}"
                                   class="flex-1 rounded-l-lg border border-gray-300 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500"
                                   placeholder="Search by title, author, description...">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-r-lg hover:bg-indigo-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Circle Filter -->
                    <div>
                        <label for="circle_filter" class="block text-sm font-medium text-gray-700 mb-1">Circle</label>
                        <select name="circle_id" id="circle_filter" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All Circles</option>
                            @foreach($circles ?? [] as $circle)
                                <option value="{{ $circle->id }}" {{ request('circle_id') == $circle->id ? 'selected' : '' }}>
                                    {{ $circle->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sub Circle Filter -->
                    <div>
                        <label for="sub_circle_filter" class="block text-sm font-medium text-gray-700 mb-1">Sub Circle</label>
                        <select name="sub_circle_id" id="sub_circle_filter" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All Sub Circles</option>
                            @foreach($subCircles ?? [] as $subCircle)
                                <option value="{{ $subCircle->id }}" 
                                        data-circle="{{ $subCircle->circle_id }}"
                                        {{ request('sub_circle_id') == $subCircle->id ? 'selected' : '' }}>
                                    {{ $subCircle->subcircle }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Type Filter -->
                    <div>
                        <label for="type_filter" class="block text-sm font-medium text-gray-700 mb-1">Resource Type</label>
                        <select name="type" id="type_filter" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All Types</option>
                            <option value="audio" {{ request('type') == 'audio' ? 'selected' : '' }}>Audio</option>
                            <option value="video" {{ request('type') == 'video' ? 'selected' : '' }}>Video</option>
                            <option value="pdf" {{ request('type') == 'pdf' ? 'selected' : '' }}>PDF</option>
                            <option value="image" {{ request('type') == 'image' ? 'selected' : '' }}>Image</option>
                            <option value="document" {{ request('type') == 'document' ? 'selected' : '' }}>Document</option>
                            <option value="other" {{ request('type') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <!-- User Filter -->
                    <div>
                        <label for="user_filter" class="block text-sm font-medium text-gray-700 mb-1">Created By</label>
                        <select name="user_id" id="user_filter" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">All Users</option>
                            @foreach($users ?? [] as $user)
                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Per Page -->
                    <div>
                        <label for="per_page" class="block text-sm font-medium text-gray-700 mb-1">Show</label>
                        <select name="per_page" id="per_page" onchange="this.form.submit()" class="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 per page</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 per page</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 per page</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 per page</option>
                        </select>
                    </div>

                    <!-- Clear Filters -->
                    <div class="flex items-end">
                        <a href="{{ route('admin.manage-resources') }}" class="w-full px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-center">
                            Clear Filters
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Resources Table Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-white rounded-lg shadow-sm">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Resources List</h3>
                        <p class="text-sm text-gray-500">Total: {{ $resources->total() ?? 0 }} items</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="p-6">
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-md">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thumbnail</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created By</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($resources ?? [] as $resource)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900">#{{ $resource->id }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($resource->thumbnail_path)
                                    <div class="h-10 w-10 rounded-lg overflow-hidden border border-gray-200">
                                        <img src="{{ Storage::url($resource->thumbnail_path) }}" 
                                             alt="Thumbnail" 
                                             class="h-10 w-10 object-cover">
                                    </div>
                                @else
                                    <div class="h-10 w-10 rounded-lg bg-gray-100 flex items-center justify-center">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-gray-900">{{ Str::limit($resource->title, 50) }}</span>
                                    @if($resource->author)
                                        <span class="text-xs text-gray-500">By: {{ $resource->author }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-xs text-gray-900">{{ $resource->circle->title ?? 'N/A' }}</span>
                                    <span class="text-xs text-gray-500">{{ $resource->subCircle->subcircle ?? '' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-medium rounded-full
                                    @if($resource->type == 'video') bg-red-100 text-red-800
                                    @elseif($resource->type == 'audio') bg-blue-100 text-blue-800
                                    @elseif($resource->type == 'pdf') bg-amber-100 text-amber-800
                                    @elseif($resource->type == 'image') bg-green-100 text-green-800
                                    @elseif($resource->type == 'document') bg-purple-100 text-purple-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($resource->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-900">{{ $resource->user->full_name ?? 'Unknown' }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $resource->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('admin.resources.preview', $resource->id) }}" 
                                       class="p-1 text-blue-600 hover:bg-blue-50 rounded" 
                                       title="Preview">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.resources.edit', $resource->id) }}" 
                                       class="p-1 text-amber-600 hover:bg-amber-50 rounded" 
                                       title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <button onclick="confirmDelete({{ $resource->id }})" 
                                            class="p-1 text-red-600 hover:bg-red-50 rounded" 
                                            title="Delete">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="p-4 bg-gray-100 rounded-full mb-4">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-1">No Resources Found</h3>
                                    <p class="text-sm text-gray-500 mb-4">Get started by creating your first resource</p>
                                    <a href="{{ route('admin.resources.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-blue-600 text-white rounded-lg hover:from-indigo-700 hover:to-blue-700">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linecap="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Create New Resource
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if(isset($resources) && $resources->hasPages())
            <div class="flex flex-col sm:flex-row justify-between items-center mt-6 pt-6 border-t border-gray-200">
                <div class="text-sm text-gray-500 mb-4 sm:mb-0">
                    Showing <span class="font-medium">{{ $resources->firstItem() }}</span> 
                    to <span class="font-medium">{{ $resources->lastItem() }}</span> 
                    of <span class="font-medium">{{ $resources->total() }}</span> entries
                </div>
                <div class="flex items-center space-x-2">
                    {{ $resources->appends(request()->query())->links('pagination::tailwind') }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-sm mx-auto">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Confirm Delete</h3>
        <p class="text-gray-600 mb-6">Are you sure you want to delete this resource? This action cannot be undone.</p>
        <div class="flex justify-end space-x-3">
            <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                Cancel
            </button>
            <form id="deleteForm" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter subcircles based on circle selection
        const circleFilter = document.getElementById('circle_filter');
        const subCircleFilter = document.getElementById('sub_circle_filter');
        
        if (circleFilter && subCircleFilter) {
            function filterSubCircles() {
                const selectedCircle = circleFilter.value;
                const options = subCircleFilter.options;
                
                // Reset subcircle filter
                for (let i = 0; i < options.length; i++) {
                    const option = options[i];
                    if (option.value === '') continue;
                    
                    if (selectedCircle === '' || option.dataset.circle === selectedCircle) {
                        option.style.display = '';
                    } else {
                        option.style.display = 'none';
                        if (option.selected) {
                            subCircleFilter.value = '';
                        }
                    }
                }
            }
            
            circleFilter.addEventListener('change', filterSubCircles);
            filterSubCircles(); // Initial filter
        }

        // Auto-submit on filter change (except search)
        document.querySelectorAll('#filterForm select:not(#per_page)').forEach(select => {
            select.addEventListener('change', function() {
                document.getElementById('filterForm').submit();
            });
        });
    });

    // Delete confirmation
    function confirmDelete(id) {
        const modal = document.getElementById('deleteModal');
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `/admin/resources/${id}`;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('deleteModal');
        if (event.target === modal) {
            closeDeleteModal();
        }
    }
</script>
@endpush
@endsection