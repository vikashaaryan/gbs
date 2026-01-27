@extends('layout.admin-layout')

@section('title', 'Manage Sub Circles')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold">Manage Sub Circles</h1>
</div>

{{-- Alerts --}}
@if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
    </div>
@endif

{{-- Add Button --}}
<button onclick="openModal()"
    class="mb-4 px-4 py-2 bg-blue-600 text-white rounded">
    + Add Sub Circle
</button>

{{-- Table --}}
<div class="bg-white rounded shadow">
<table class="w-full border">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-3 border text-left">ID</th>
            <th class="p-3 border text-left">Circle</th>
            <th class="p-3 border text-left">Sub Circle</th>
            <th class="p-3 border text-left">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($subCircles as $sub)
        <tr class="border-t">
            <td class="p-3 border">{{ $sub->id }}</td>
            <td class="p-3 border">{{ $sub->circle->title }}</td>
            <td class="p-3 border">{{ $sub->subcircle }}</td>
            <td class="p-3 flex gap-2">
                <button onclick="editModal({{ $sub->id }}, '{{ $sub->circle_id }}', '{{ addslashes($sub->subcircle) }}')"
                    class="text-blue-600">Edit</button>

                <form method="POST" action="{{ route('admin.sub-circles.destroy', $sub->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600"
                        onclick="return confirm('Delete this sub circle?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

{{-- Modal --}}
<div id="modal" class="fixed inset-0 bg-black/50 hidden flex items-center justify-center">
<div class="bg-white w-full max-w-md rounded p-6">
    <h2 id="modalTitle" class="text-lg font-semibold mb-4">Add Sub Circle</h2>

    <form id="subCircleForm" method="POST" action="{{ route('admin.sub-circles.store') }}">
        @csrf
        <input type="hidden" name="_method" id="method" value="POST">

        <div class="mb-4">
            <label class="block mb-1">Circle *</label>
            <select name="circle_id" id="circle_id" class="w-full border p-2" required>
                <option value="">Select Circle</option>
                @foreach($circles as $circle)
                    <option value="{{ $circle->id }}">{{ $circle->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1">Sub Circle *</label>
            <input type="text" name="subcircle" id="subcircle"
                class="w-full border p-2" required>
        </div>

        <div class="flex justify-end gap-2">
            <button type="button" onclick="closeModal()"
                class="px-4 py-2 border">Cancel</button>
            <button class="px-4 py-2 bg-blue-600 text-white">
                Save
            </button>
        </div>
    </form>
</div>
</div>
@endsection

@push('scripts')
<script>
function openModal() {
    document.getElementById('modal').classList.remove('hidden');
    document.getElementById('modalTitle').innerText = 'Add Sub Circle';
    document.getElementById('subCircleForm').action = "{{ route('admin.sub-circles.store') }}";
    document.getElementById('method').value = 'POST';
    document.getElementById('subCircleForm').reset();
}

function editModal(id, circleId, subcircle) {
    openModal();
    document.getElementById('modalTitle').innerText = 'Edit Sub Circle';
    document.getElementById('circle_id').value = circleId;
    document.getElementById('subcircle').value = subcircle;
    document.getElementById('subCircleForm').action = `/admin/sub-circles/${id}`;
    document.getElementById('method').value = 'PUT';
}

function closeModal() {
    document.getElementById('modal').classList.add('hidden');
}
</script>
@endpush
