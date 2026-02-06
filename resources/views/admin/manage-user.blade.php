@extends('layout.admin-layout')

@section('title', 'Manage Users')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manage Users</h1>
        <p class="text-gray-600 mt-2">Manage and verify user accounts</p>
    </div>
 <!-- Stats Summary -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white rounded-lg shadow-md p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Users</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-8 w-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Verified Users</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $verifiedUsers }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-8 w-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Not Verified</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $totalUsers - $verifiedUsers }}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Filters Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Search -->
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                <input type="text" 
                       id="search" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Name, email, phone..."
                       value="{{ request('search') }}">
            </div>

            <!-- Verification Filter -->
            <div>
                <label for="verified_filter" class="block text-sm font-medium text-gray-700 mb-1">Verification Status</label>
                <select id="verified_filter" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Users</option>
                    <option value="1" {{ request('verified') == '1' ? 'selected' : '' }}>Verified</option>
                    <option value="0" {{ request('verified') == '0' ? 'selected' : '' }}>Not Verified</option>
                </select>
            </div>

            <!-- Circle Filter -->
            <div>
                <label for="circle_filter" class="block text-sm font-medium text-gray-700 mb-1">Circle</label>
                <select id="circle_filter" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Circles</option>
                    @foreach($circles as $circle)
                        <option value="{{ $circle->id }}" {{ request('circle_id') == $circle->id ? 'selected' : '' }}>
                            {{ $circle->title }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-4 flex space-x-2">
            <button id="applyFilters" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                Apply Filters
            </button>
            <button id="resetFilters" 
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                Reset Filters
            </button>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            User Info
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Location
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Circle Info
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                        <td class="px-6 py-4">
                            <div class="flex items-start">
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $user->full_name }}</div>
                                    <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                    <div class="text-sm text-gray-500">{{ $user->phone }}</div>
                                    <div class="text-sm text-gray-500 mt-1">
                                        <span class="font-medium">Occupation:</span> {{ $user->occupation ?? 'N/A' }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $user->district }}</div>
                            <div class="text-sm text-gray-500">{{ $user->state }}, {{ $user->country }}</div>
                            <div class="text-sm text-gray-500">Pincode: {{ $user->pincode }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                @if($user->circle)
                                    {{ $user->circle->title }}
                                @else
                                    <span class="text-gray-400 italic">No Circle</span>
                                @endif
                            </div>
                            <div class="text-sm text-gray-500">
                                @if($user->subCircle)
                                    {{ $user->subCircle->subcircle }}
                                @endif
                            </div>
                            <div class="text-sm text-gray-500">
                                <span class="font-medium">Interests:</span> {{ $user->interests ?? 'N/A' }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->verified ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $user->verified ? 'Verified' : 'Not Verified' }}
                            </span>
                            <div class="text-xs text-gray-500 mt-1">
                                Joined: {{ $user->created_at->format('M d, Y') }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium">
                            <button onclick="toggleVerification({{ $user->id }}, {{ $user->verified ? '0' : '1' }})"
                                    class="px-3 py-1 {{ $user->verified ? 'bg-red-100 text-red-700 hover:bg-red-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }} rounded-md transition duration-150 ease-in-out">
                                {{ $user->verified ? 'Unverify' : 'Verify' }}
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.67 3.137a10 10 0 01-.671 5.197M21 21h-6m6 0v-1a6 6 0 00-6-6v1a6 6 0 006 6z" />
                                </svg>
                                <p class="text-lg font-medium text-gray-700">No users found</p>
                                <p class="text-sm text-gray-500 mt-1">Try adjusting your filters or search terms</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($users->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $users->appends(request()->except('page'))->links() }}
        </div>
        @endif
    </div>

   
</div>

<!-- JavaScript for filtering and verification -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search');
    const verifiedFilter = document.getElementById('verified_filter');
    const circleFilter = document.getElementById('circle_filter');
    const applyFiltersBtn = document.getElementById('applyFilters');
    const resetFiltersBtn = document.getElementById('resetFilters');

    // Apply Filters
    applyFiltersBtn.addEventListener('click', function() {
        const filters = {
            search: searchInput.value,
            verified: verifiedFilter.value,
            circle_id: circleFilter.value
        };

        // Remove empty filters
        Object.keys(filters).forEach(key => {
            if (!filters[key]) delete filters[key];
        });

        // Build query string
        const queryString = new URLSearchParams(filters).toString();
        window.location.href = '{{ route("admin.manage-users") }}?' + queryString;
    });

    // Reset Filters
    resetFiltersBtn.addEventListener('click', function() {
        window.location.href = '{{ route("admin.manage-users") }}';
    });

    // Enable Enter key to apply filters in search
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            applyFiltersBtn.click();
        }
    });
});

function toggleVerification(userId, status) {
    const action = status ? 'verify' : 'unverify';
    const userName = document.querySelector(`tr[data-user-id="${userId}"]`)?.querySelector('.user-name')?.textContent || 'this user';
    
    if (!confirm(`Are you sure you want to ${action} ${userName}?`)) {
        return;
    }

    fetch(`/admin/users/${userId}/toggle-verification`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            verified: status
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message
            showNotification(`User successfully ${action}ed!`, 'success');
            // Reload after 1 second
            setTimeout(() => {
                location.reload();
            }, 1000);
        } else {
            showNotification('Error: ' + data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('An error occurred. Please try again.', 'error');
    });
}

// Simple notification function
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg text-white ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} z-50`;
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
</script>
@endsection