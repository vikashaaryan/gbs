@extends('layout.admin-layout')

@section('title', 'Manage Circles')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manage Circles</h1>
        <p class="text-gray-600 mt-2">Add, edit, and delete circles</p>
    </div>

    <!-- Display Success/Error Messages -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Add Circle Button -->
    <div class="mb-6">
        <button onclick="openCircleModal()" 
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-teal-600 text-white font-medium rounded-lg hover:bg-teal-700 transition-all">
            <i class="fas fa-plus-circle"></i>
            Add New Circle
        </button>
    </div>

    <!-- Circles Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Circle</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subcategory</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($circles as $circle)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $circle->id }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @if($circle->parent_id)
                                        <i class="fas fa-folder text-blue-500 mr-2"></i>
                                    @else
                                        <i class="fas fa-layer-group text-teal-500 mr-2"></i>
                                    @endif
                                    <span class="font-medium">{{ $circle->category }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $circle->parent ? $circle->parent->category : '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $circle->description ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <div class="flex items-center space-x-2">
                                    <!-- Edit Button -->
                                    <button onclick="openCircleModal({{ $circle->id }}, '{{ $circle->category }}', '{{ $circle->parent_id }}', '{{ $circle->description ?? '' }}')"
                                            class="text-blue-600 hover:text-blue-900 p-1.5 rounded hover:bg-blue-50">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <!-- Delete Button -->
                                    <button onclick="deleteCircle({{ $circle->id }}, '{{ $circle->category }}')"
                                            class="text-red-600 hover:text-red-900 p-1.5 rounded hover:bg-red-50">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                No circles found. Add your first circle!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Single Modal for Add/Edit -->
    <div id="circleModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="min-h-screen flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-lg max-w-md w-full">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4" id="modalTitle">Add New Circle</h3>
                    <form id="circleForm" method="POST">
                        @csrf
                        <input type="hidden" id="formMethod" name="_method" value="POST">
                        <input type="hidden" id="circleId" name="id">
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Circle Name *</label>
                                <input type="text" id="category" name="category" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                       placeholder="Enter circle name">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Subcategory</label>
                                <select id="parent_id" name="parent_id" 
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                                    <option value="">None (Main Category)</option>
                                    @foreach($parentCircles as $parent)
                                        <option value="{{ $parent->id }}">{{ $parent->category }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <input type="text" id="description" name="description"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                       placeholder="Enter description (optional)">
                            </div>
                        </div>
                        
                        <div class="flex justify-end space-x-3 mt-6">
                            <button type="button" onclick="closeCircleModal()"
                                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                                Cancel
                            </button>
                            <button type="submit" id="submitButton"
                                    class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors">
                                Save Circle
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="min-h-screen flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-lg max-w-sm w-full">
                <div class="p-6">
                    <div class="text-center mb-6">
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Delete Circle</h3>
                        <p class="text-gray-600" id="deleteMessage">Are you sure you want to delete this circle?</p>
                    </div>

                    <div class="flex items-center justify-center gap-3">
                        <button onclick="closeDeleteModal()"
                                class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50">
                            Cancel
                        </button>
                        <form id="deleteForm" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-4 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Open modal for Add (no parameters) or Edit (with parameters)
    function openCircleModal(id = null, category = '', parentId = '', description = '') {
        const modal = document.getElementById('circleModal');
        const title = document.getElementById('modalTitle');
        const form = document.getElementById('circleForm');
        const methodInput = document.getElementById('formMethod');
        const submitButton = document.getElementById('submitButton');
        const circleIdInput = document.getElementById('circleId');
        
        form.reset();
        
        if (id) {
            title.textContent = 'Edit Circle';
            circleIdInput.value = id;
            document.getElementById('category').value = category;
            document.getElementById('parent_id').value = parentId || '';
            document.getElementById('description').value = description;
            
            form.action = `/admin/circles/${id}`;
            methodInput.value = 'PUT';
            submitButton.textContent = 'Update Circle';
            submitButton.className = 'px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors';
        } else {
            title.textContent = 'Add New Circle';
            circleIdInput.value = '';
            
            form.action = `/admin/circles`;
            methodInput.value = 'POST';
            submitButton.textContent = 'Save Circle';
            submitButton.className = 'px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors';
        }
        
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    function closeCircleModal() {
        document.getElementById('circleModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    
    function deleteCircle(id, category) {
        const modal = document.getElementById('deleteModal');
        const message = document.getElementById('deleteMessage');
        const form = document.getElementById('deleteForm');
        
        message.textContent = `Are you sure you want to delete "${category}"?`;
        form.action = `/admin/circles/${id}`;
        
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    
    document.getElementById('circleModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeCircleModal();
        }
    });
    
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (!document.getElementById('circleModal').classList.contains('hidden')) {
                closeCircleModal();
            }
            if (!document.getElementById('deleteModal').classList.contains('hidden')) {
                closeDeleteModal();
            }
        }
    });
</script>
@endpush