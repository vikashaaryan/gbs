@extends('layout.admin-layout')

@section('title', 'Manage Categories')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manage Categories</h1>
        <p class="text-gray-600 mt-2">Manage your categories and subcategories</p>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Add Category Button -->
    <div class="mb-6">
        <button onclick="openCategoryModal()" 
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
            <i class="fas fa-plus-circle"></i>
            Add New Category
        </button>
    </div>

    <!-- Categories Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($categories as $category)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $category->id }}</td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-800">{{ $category->title }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-600">{{ $category->description ?? '—' }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full {{ $category->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $category->status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $category->created_at ? $category->created_at->format('d M Y') : '—' }}
                        </td>
                        <td class="px-6 py-4">
                            <button onclick="openCategoryModal({{ $category->id }}, '{{ addslashes($category->title) }}', '{{ addslashes($category->description ?? '') }}', {{ $category->status ? 'true' : 'false' }})"
                                    class="text-blue-600 hover:text-blue-900 p-2 rounded transition" title="Edit">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="deleteCategory({{ $category->id }}, '{{ addslashes($category->title) }}')"
                                    class="text-red-600 hover:text-red-900 p-2 rounded transition" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            <i class="fas fa-folder-open text-gray-300 text-3xl mb-2"></i>
                            <p>No categories found. Add your first category!</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Add/Edit Modal -->
    <div id="categoryModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 overflow-y-auto">
        <div class="min-h-screen flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <!-- Modal Header -->
                <div class="flex justify-between items-center p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-800" id="modalTitle">Add New Category</h3>
                    <button onclick="closeCategoryModal()" class="text-gray-400 hover:text-gray-600 transition">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <!-- Modal Body -->
                <div class="p-6">
                    <form id="categoryForm" method="POST">
                        @csrf
                        <input type="hidden" id="formMethod" name="_method" value="POST">
                        <input type="hidden" id="categoryId" name="id">
                        
                        <div class="space-y-4">
                            <!-- Title Field -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Category Title <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       id="title" 
                                       name="title" 
                                       required 
                                       maxlength="255"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="Enter category title (e.g., Doctor, Engineer, Teacher)">
                                <p class="text-xs text-gray-500 mt-1">Maximum 255 characters</p>
                            </div>
                            
                            <!-- Description Field -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Description <span class="text-gray-400">(Optional)</span>
                                </label>
                                <textarea id="description" 
                                          name="description" 
                                          rows="3"
                                          maxlength="1000"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                          placeholder="Enter description about this category"></textarea>
                                <p class="text-xs text-gray-500 mt-1">Maximum 1000 characters</p>
                            </div>
                            
                            <!-- Status Field -->
                            <div class="flex items-center">
                                <input type="checkbox" 
                                       id="status" 
                                       name="status" 
                                       value="1"
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                <label for="status" class="ml-2 block text-sm text-gray-700">
                                    Active Status
                                </label>
                            </div>
                        </div>
                        
                        <!-- Modal Footer -->
                        <div class="flex justify-end space-x-3 mt-6 pt-4 border-t">
                            <button type="button" 
                                    onclick="closeCategoryModal()"
                                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                                Cancel
                            </button>
                            <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                Save Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="min-h-screen flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-sm w-full p-6">
                <div class="text-center">
                    <i class="fas fa-exclamation-triangle text-yellow-500 text-4xl mb-4"></i>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Delete Category</h3>
                    <p class="text-gray-600 mb-6" id="deleteMessage">Are you sure you want to delete this category?</p>
                </div>
                
                <div class="flex justify-center space-x-3">
                    <button onclick="closeDeleteModal()" 
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                        Cancel
                    </button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Open Add/Edit Modal
    window.openCategoryModal = function(id = null, title = '', description = '', status = true) {
        const modal = document.getElementById('categoryModal');
        const modalTitle = document.getElementById('modalTitle');
        const form = document.getElementById('categoryForm');
        
        // Reset form
        form.reset();
        document.getElementById('categoryId').value = '';
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('status').checked = true; // Default checked
        
        if (id) {
            // Edit mode
            modalTitle.textContent = 'Edit Category';
            document.getElementById('categoryId').value = id;
            document.getElementById('title').value = title;
            document.getElementById('description').value = description;
            document.getElementById('status').checked = status;
            form.action = `/admin/manage-category/${id}`;
            document.getElementById('formMethod').value = 'PUT';
        } else {
            // Add mode
            modalTitle.textContent = 'Add New Category';
            form.action = `/admin/manage-category`;
        }
        
        modal.classList.remove('hidden');
        // Focus on title field
        setTimeout(() => {
            document.getElementById('title').focus();
        }, 200);
    };

    // Close Modal
    window.closeCategoryModal = function() {
        document.getElementById('categoryModal').classList.add('hidden');
    };

    // Open Delete Modal
    window.deleteCategory = function(id, title) {
        document.getElementById('deleteMessage').textContent = `Are you sure you want to delete "${title}"?`;
        document.getElementById('deleteForm').action = `/admin/manage-category/${id}`;
        document.getElementById('deleteModal').classList.remove('hidden');
    };

    // Close Delete Modal
    window.closeDeleteModal = function() {
        document.getElementById('deleteModal').classList.add('hidden');
    };

    // Close modals on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeCategoryModal();
            closeDeleteModal();
        }
    });

    // Close modal when clicking outside (optional)
    document.getElementById('categoryModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeCategoryModal();
        }
    });

    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });

    // Form validation
    document.getElementById('categoryForm').addEventListener('submit', function(e) {
        const title = document.getElementById('title').value.trim();
        if (!title) {
            e.preventDefault();
            alert('Please enter a category title');
            return false;
        }
    });
</script>
@endpush