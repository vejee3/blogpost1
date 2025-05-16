<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class AdminController extends Controller
{
    public function dashboard()
    {
        Log::info('Session Data:', session()->all()); // Log session data
        $posts = Post::where('is_approved', false)->get();
        return view('admin.dashboard', compact('posts'));
    }

    public function approvePost($id)
    {
        $post = Post::findOrFail($id);
        $post->is_approved = true; // Set the post as approved
        $post->save();

        return redirect()->route('admin.dashboard')->with('success', 'Post approved successfully.');
    }
}
