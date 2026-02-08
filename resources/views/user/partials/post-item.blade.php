@php
    // Safely access user data
    $postUser = $post->user ?? null;
    $authUser = auth()->user();
@endphp

<div class="post-item bg-white rounded-xl shadow-md mb-6 overflow-hidden border border-gray-200" data-post-id="{{ $post->id }}">
    <!-- Post Header -->
    <div class="p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-10 h-10 rounded-full overflow-hidden mr-3">
                    @if($postUser && $postUser->photo)
                        <img src="{{ Storage::url($postUser->photo) }}" 
                             alt="{{ $postUser->full_name }}" 
                             class="w-full h-full object-cover">
                    @else
                        @php
                            // Generate gradient based on user ID or name
                            $colors = [
                                'from-blue-500 to-cyan-500',
                                'from-purple-500 to-pink-500',
                                'from-green-500 to-teal-500',
                                'from-red-500 to-orange-500',
                                'from-indigo-500 to-purple-500',
                            ];
                            $colorIndex = $post->user_id % count($colors);
                        @endphp
                        <div class="w-full h-full bg-gradient-to-r {{ $colors[$colorIndex] }} flex items-center justify-center">
                            @if($postUser)
                                <span class="text-white font-semibold text-sm">
                                    {{ strtoupper(substr($postUser->full_name, 0, 1)) }}
                                </span>
                            @else
                                <i class="fas fa-user text-white"></i>
                            @endif
                        </div>
                    @endif
                </div>
                <div>
                    <h4 class="font-bold text-gray-800">{{ $postUser ? $postUser->full_name : 'Unknown User' }}</h4>
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <span>{{ $post->created_at->diffForHumans() }}</span>
                        @if($postUser && $postUser->circle)
                            <span class="w-1 h-1 bg-gray-400 rounded-full"></span>
                            <span class="flex items-center gap-1">
                                <i class="{{ $postUser->circle->icon ?? 'fas fa-users' }} text-xs"></i>
                                {{ $postUser->circle->title }}
                            </span>
                        @endif
                        @if($post->type != 'text')
                            <span class="w-1 h-1 bg-gray-400 rounded-full"></span>
                            <span class="px-2 py-0.5 rounded-full text-xs {{ $post->getMediaColor() }}">
                                <i class="{{ $post->getMediaIcon() }} mr-1"></i>
                                {{ ucfirst($post->type) }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            
            @if($post->user_id == ($authUser ? $authUser->id : null))
                <div class="relative">
                    <button type="button" class="post-options-btn text-gray-400 hover:text-gray-600 p-1">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <div class="post-options-menu hidden absolute right-0 mt-1 w-32 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-10">
                        <button type="button" onclick="editPost({{ $post->id }})" 
                            class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-edit mr-2"></i> Edit
                        </button>
                        <button type="button" onclick="deletePost({{ $post->id }})" 
                            class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                            <i class="fas fa-trash mr-2"></i> Delete
                        </button>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Post Description -->
        @if($post->description)
            <p class="mt-3 text-gray-700 whitespace-pre-line">{{ $post->description }}</p>
        @endif
    </div>

    <!-- Post Media -->
    @if($post->type != 'text')
        <div class="border-t border-gray-100">
            @if($post->type == 'photo' && $post->photo)
                <img src="{{ Storage::url($post->photo) }}" 
                     alt="Post image" 
                     class="w-full max-h-96 object-cover cursor-pointer"
                     onclick="openMediaModal('{{ Storage::url($post->photo) }}', 'image')">
            @endif
            
            @if($post->type == 'video' && $post->video)
                <div class="relative">
                    <video src="{{ Storage::url($post->video) }}" 
                           class="w-full max-h-96 object-cover"
                           controls
                           preload="metadata"></video>
                </div>
            @endif
            
            @if($post->type == 'audio' && $post->audio)
                <div class="px-4 pb-4">
                    <div class="bg-gradient-to-r from-purple-50 to-indigo-50 rounded-xl p-4">
                        <div class="flex items-center mb-3">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-music text-purple-600 text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-800">Audio Post</h4>
                                <p class="text-sm text-gray-500">Click to play</p>
                            </div>
                        </div>
                        <audio src="{{ Storage::url($post->audio) }}" 
                               controls 
                               class="w-full"
                               preload="metadata"></audio>
                    </div>
                </div>
            @endif
            
            @if($post->type == 'document' && $post->document)
                <div class="p-4">
                    <div class="bg-gradient-to-r from-red-50 to-orange-50 rounded-xl p-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-file-pdf text-red-600 text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-800">
                                        {{ basename($post->document) }}
                                    </h4>
                                    <p class="text-sm text-gray-500">Document</p>
                                </div>
                            </div>
                            <a href="{{ Storage::url($post->document) }}" 
                               target="_blank"
                               class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium">
                                <i class="fas fa-download mr-1"></i> Download
                            </a>
                        </div>
                    </div>
                </div>
            @endif
            
            @if($post->type == 'mixed' && $post->media)
                <div class="p-4">
                    <div class="grid grid-cols-2 gap-2">
                        @foreach($post->media as $media)
                            @if($media['type'] == 'photo')
                                <img src="{{ Storage::url($media['path']) }}" 
                                     alt="Media" 
                                     class="w-full h-40 object-cover rounded-lg cursor-pointer"
                                     onclick="openMediaModal('{{ Storage::url($media['path']) }}', 'image')">
                            @endif
                        @endforeach
                    </div>
                    <div class="mt-3">
                        @foreach($post->media as $media)
                            @if(in_array($media['type'], ['video', 'audio', 'document']))
                                <div class="flex items-center gap-2 mb-2 p-2 bg-gray-50 rounded-lg">
                                    <i class="fas fa-{{ 
                                        $media['type'] == 'video' ? 'video' : 
                                        ($media['type'] == 'audio' ? 'music' : 'file') 
                                    }} text-gray-600"></i>
                                    <span class="text-sm text-gray-700">{{ basename($media['path']) }}</span>
                                    <a href="{{ Storage::url($media['path']) }}" 
                                       target="_blank"
                                       class="ml-auto text-blue-600 hover:text-blue-800 text-sm">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    @endif

    <!-- Post Stats -->
    <div class="px-4 py-3 border-t border-gray-100">
        <div class="flex items-center justify-between text-gray-500 text-sm">
            <div class="flex items-center space-x-4">
                <span class="flex items-center post-likes-count" data-post-id="{{ $post->id }}">
                    <i class="fas fa-thumbs-up text-blue-500 mr-1"></i> 
                    <span class="count">{{ $post->likes_count }}</span>
                </span>
                <span class="flex items-center post-comments-count" data-post-id="{{ $post->id }}">
                    <i class="fas fa-comment mr-1"></i> 
                    <span class="count">{{ $post->comments_count }}</span>
                </span>
                <span class="flex items-center">
                    <i class="fas fa-share mr-1"></i> 
                    <span>{{ $post->shares_count }}</span>
                </span>
            </div>
            <span class="text-xs">{{ $post->views_count ?? 0 }} views</span>
        </div>
    </div>

    <!-- Post Actions -->
    <div class="border-t border-gray-100">
        <div class="flex">
            @auth
            <button onclick="toggleLike({{ $post->id }})" 
                    class="flex-1 py-3 text-center hover:bg-gray-50 transition-colors like-btn"
                    data-post-id="{{ $post->id }}">
                <i class="far fa-thumbs-up mr-2 {{ $post->hasLiked(auth()->id()) ? 'hidden' : '' }}"></i>
                <i class="fas fa-thumbs-up mr-2 text-blue-600 {{ $post->hasLiked(auth()->id()) ? '' : 'hidden' }}"></i>
                <span class="like-text">{{ $post->hasLiked(auth()->id()) ? 'Liked' : 'Like' }}</span>
            </button>
            <button onclick="showCommentBox({{ $post->id }})" 
                    class="flex-1 py-3 text-center hover:bg-gray-50 transition-colors">
                <i class="far fa-comment mr-2"></i> Comment
            </button>
            @else
            <button onclick="window.location.href='{{ route('login') }}'" 
                    class="flex-1 py-3 text-center hover:bg-gray-50 transition-colors">
                <i class="far fa-thumbs-up mr-2"></i> Like
            </button>
            <button onclick="window.location.href='{{ route('login') }}'" 
                    class="flex-1 py-3 text-center hover:bg-gray-50 transition-colors">
                <i class="far fa-comment mr-2"></i> Comment
            </button>
            @endauth
            <button class="flex-1 py-3 text-center hover:bg-gray-50 transition-colors">
                <i class="far fa-share-square mr-2"></i> Share
            </button>
        </div>
    </div>

    <!-- Comments Section -->
    @auth
    <div class="border-t border-gray-100 comments-section" id="comments-{{ $post->id }}" style="display: none;">
        <!-- Add Comment Form -->
        <div class="p-4">
            <form class="add-comment-form" data-post-id="{{ $post->id }}">
                @csrf
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full overflow-hidden flex-shrink-0">
                        @if(auth()->user()->photo)
                            <img src="{{ Storage::url(auth()->user()->photo) }}" 
                                 alt="{{ auth()->user()->full_name }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-r from-blue-500 to-cyan-500 flex items-center justify-center">
                                <span class="text-white font-semibold text-xs">
                                    {{ strtoupper(substr(auth()->user()->full_name, 0, 1)) }}
                                </span>
                            </div>
                        @endif
                    </div>
                    <input type="text" 
                           name="comment" 
                           placeholder="Write a comment..." 
                           class="flex-1 border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-none focus:border-blue-500">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white rounded-full w-8 h-8 flex items-center justify-center">
                        <i class="fas fa-paper-plane text-sm"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Comments List -->
        <div class="comments-list px-4 pb-4 max-h-64 overflow-y-auto" id="comments-list-{{ $post->id }}">
            @foreach($post->comments as $comment)
                @include('user.partials.comment-item', ['comment' => $comment])
            @endforeach
        </div>
    </div>
    @endauth
</div>