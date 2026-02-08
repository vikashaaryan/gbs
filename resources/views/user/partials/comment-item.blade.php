@php
    $commentUser = $comment->user ?? null;
@endphp

<div class="comment-item mb-3" data-comment-id="{{ $comment->id }}">
    <div class="flex items-start">
        <div class="w-6 h-6 rounded-full overflow-hidden mr-2 flex-shrink-0">
            @if($commentUser && $commentUser->photo)
                <img src="{{ Storage::url($commentUser->photo) }}" 
                     alt="{{ $commentUser->full_name }}" 
                     class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-gradient-to-r from-gray-500 to-gray-600 flex items-center justify-center">
                    @if($commentUser)
                        <span class="text-white text-xs">
                            {{ strtoupper(substr($commentUser->full_name, 0, 1)) }}
                        </span>
                    @else
                        <i class="fas fa-user text-white text-xs"></i>
                    @endif
                </div>
            @endif
        </div>
        <div class="flex-1">
            <div class="bg-gray-100 rounded-2xl px-3 py-2">
                <div class="flex items-center gap-2 mb-1">
                    <span class="font-medium text-sm text-gray-800">
                        {{ $commentUser ? $commentUser->full_name : 'Unknown User' }}
                    </span>
                    <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-sm text-gray-700">{{ $comment->comment }}</p>
            </div>
            <div class="flex items-center gap-3 mt-1 ml-2">
                <button class="text-xs text-gray-500 hover:text-blue-600">Like</button>
                <button class="text-xs text-gray-500 hover:text-blue-600">Reply</button>
            </div>
        </div>
    </div>
</div>