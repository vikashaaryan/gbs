<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Circle;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostLike;
use App\Models\PostComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Show posts feed and directory
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

        // Get all users for directory with their circle and sub-circle relationships
        $users = User::with(['circle', 'subCircle'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        // Get all users for filter options (without pagination)
        $allUsers = User::with(['circle', 'subCircle'])->get();
        
        // Get active circles
        $circles = Circle::where('status', true)->get();

        return view('user.user-panel', compact('posts', 'circles', 'users', 'allUsers'));
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

    // API endpoint to get sub-circles for a circle
    public function getSubCircles($circleId)
    {
        $circle = Circle::with('subCircles')->find($circleId);
        
        if (!$circle) {
            return response()->json(['error' => 'Circle not found'], 404);
        }

        return response()->json($circle->subCircles);
    }

    // Handle contact request from directory
    public function submitContactRequest(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'message' => 'nullable|string|max:1000',
            'interests' => 'nullable|array'
        ]);

        // Get the target user
        $targetUser = User::find($request->user_id);

        // Here you can:
        // 1. Store the contact request in database
        // 2. Send email notification to the target user
        // 3. Send SMS notification
        // 4. Create a notification in the system

        // For now, we'll just return success
        // You can create a ContactRequest model to store these

        return response()->json([
            'success' => true,
            'message' => 'Contact request sent successfully',
            'data' => [
                'target_user' => $targetUser->full_name,
                'requester_name' => $request->name,
                'requester_phone' => $request->phone
            ]
        ]);
    }

    // Get directory filters data
    public function getDirectoryFilters()
    {
        $countries = User::whereNotNull('country')->distinct()->pluck('country');
        $states = User::whereNotNull('state')->distinct()->pluck('state');
        $districts = User::whereNotNull('district')->distinct()->pluck('district');
        $occupations = User::whereNotNull('occupation')->distinct()->pluck('occupation');
        $circles = Circle::where('status', true)->get();

        return response()->json([
            'countries' => $countries,
            'states' => $states,
            'districts' => $districts,
            'occupations' => $occupations,
            'circles' => $circles
        ]);
    }

    // Filter directory users
    public function filterDirectory(Request $request)
    {
        $query = User::with(['circle', 'subCircle']);

        // Apply filters
        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }

        if ($request->filled('state')) {
            $query->where('state', $request->state);
        }

        if ($request->filled('district')) {
            $query->where('district', $request->district);
        }

        if ($request->filled('circle_id')) {
            $query->where('circle_id', $request->circle_id);
        }

        if ($request->filled('occupation')) {
            $query->where('occupation', 'LIKE', '%' . $request->occupation . '%');
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'LIKE', '%' . $search . '%')
                  ->orWhere('occupation', 'LIKE', '%' . $search . '%')
                  ->orWhere('interests', 'LIKE', '%' . $search . '%');
            });
        }

        // Apply sorting
        switch ($request->sort_by) {
            case 'name_asc':
                $query->orderBy('full_name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('full_name', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $users = $query->paginate(10);

        return response()->json([
            'users' => $users,
            'filters_applied' => $request->all()
        ]);
    }

    // Get single user details
    public function getUserDetails($id)
    {
        $user = User::with(['circle', 'subCircle'])->findOrFail($id);

        return response()->json([
            'user' => $user
        ]);
    }
}