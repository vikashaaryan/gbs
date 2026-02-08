<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\PostComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Show posts feed
    public function index()
    {
        // Initialize posts variable
        $posts = collect();
        
        // Check if user is authenticated
        if (Auth::check()) {
            $user = Auth::user();
            
            // If user is in a circle, show posts from same circle users
            if ($user->circle_id) {
                $posts = Post::with(['user', 'likes', 'comments.user'])
                    ->whereHas('user', function ($query) use ($user) {
                        $query->where('circle_id', $user->circle_id);
                    })
                    ->orWhere('user_id', $user->id)
                    ->latest()
                    ->paginate(10);
            } else {
                // Show all posts if no circle
                $posts = Post::with(['user', 'likes', 'comments.user'])
                    ->latest()
                    ->paginate(10);
            }
        } else {
            // Show public posts for guests
            $posts = Post::with(['user', 'likes', 'comments.user'])
                ->latest()
                ->paginate(10);
        }
        
        return view('user.user-panel', compact('posts'));
    }

    // Create new post
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'nullable|string|max:5000',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:51200',
            'audio' => 'nullable|mimes:mp3,wav,m4a|max:10240',
            'document' => 'nullable|mimes:pdf,doc,docx,txt|max:10240',
        ]);

        $post = new Post();
        $post->user_id = Auth::id();
        $post->description = $request->description;

        $media = [];

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('posts/photos', 'public');
            $post->photo = $path;
            $media[] = ['type' => 'photo', 'path' => $path];
        }

        // Handle video upload
        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('posts/videos', 'public');
            $post->video = $path;
            $media[] = ['type' => 'video', 'path' => $path];
        }

        // Handle audio upload
        if ($request->hasFile('audio')) {
            $path = $request->file('audio')->store('posts/audio', 'public');
            $post->audio = $path;
            $media[] = ['type' => 'audio', 'path' => $path];
        }

        // Handle document upload
        if ($request->hasFile('document')) {
            $path = $request->file('document')->store('posts/documents', 'public');
            $post->document = $path;
            $media[] = ['type' => 'document', 'path' => $path];
        }

        // Determine post type
        if (count($media) > 1) {
            $post->type = 'mixed';
        } elseif (count($media) === 1) {
            $post->type = $media[0]['type'];
        } else {
            $post->type = 'text';
        }

        $post->media = $media;
        
        // Initialize counts
        $post->likes_count = 0;
        $post->comments_count = 0;
        $post->shares_count = 0;
        
        $post->save();

        // Load user relationship
        $post->load('user');

        return redirect()->route('user');
    }
    // Like/Unlike post
    public function toggleLike($postId)
    {
        $user = Auth::user();
        $like = PostLike::where('user_id', $user->id)
            ->where('post_id', $postId)
            ->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            PostLike::create([
                'user_id' => $user->id,
                'post_id' => $postId
            ]);
            $liked = true;
        }

        // Update likes count
        $post = Post::find($postId);
        $post->likes_count = $post->likes()->count();
        $post->save();

        return response()->json([
            'liked' => $liked,
            'likes_count' => $post->likes_count
        ]);
    }

    // Add comment
    public function addComment(Request $request, $postId)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:post_comments,id'
        ]);

        $comment = PostComment::create([
            'user_id' => Auth::id(),
            'post_id' => $postId,
            'parent_id' => $request->parent_id,
            'comment' => $request->comment
        ]);

        // Update comments count
        $post = Post::find($postId);
        $post->comments_count = $post->comments()->count();
        $post->save();

        return response()->json([
            'success' => true,
            'comment' => $comment->load('user'),
            'comments_count' => $post->comments_count
        ]);
    }

    // Delete post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        
        if ($post->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Delete media files
        if ($post->photo) Storage::disk('public')->delete($post->photo);
        if ($post->video) Storage::disk('public')->delete($post->video);
        if ($post->audio) Storage::disk('public')->delete($post->audio);
        if ($post->document) Storage::disk('public')->delete($post->document);

        $post->delete();

        return response()->json(['success' => true]);
    }
}