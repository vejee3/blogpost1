<?php
 
namespace App\Http\Controllers;
 
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
 
class PostController extends Controller

{
    public function index()
    {
        // Fetch only approved posts
        $posts = Post::where('is_approved', true)->get();
        return view('index', compact('posts'));
    }
    public function showLoginForm() // Method to show the login form
{
    return view('auth.login'); // Ensure this points to the correct view
}
    public function showRegistrationForm() // Method to show the registration form
{
    return view('auth.register'); // Adjust the view path as necessary
}

public function registerForm()
{
    return view('auth.register'); // Return the registration view
}

public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed', // Ensure password is at least 8 characters and confirmed
    ]);

    // Create the user
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), // Hash the password
    ]);

    // Redirect to the login page after registration
    return redirect()->route('login.form')->with('success', 'Registration successful! Please log in.');
}

    

public function loginForm()
{
    return view('auth.login'); // Return the login view
}

public function login(Request $request)
{
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        // Check if the user is an admin
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard'); // Redirect to admin dashboard
        } else {
            return redirect()->route('index'); // Redirect to user landing page
        }
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}

public function logout(Request $request) // Method to handle logout
{
    Auth::logout(); // Log the user out
    return redirect('/'); // Redirect to the home page or login page
}

   
 
    public function create()
    {
        return view('create');
    }
     
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'body' => 'required|string',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Make cover required
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->author = $request->author;
        $post->body = $request->body;
        $post->is_approved = false; // Set to false initially

        // Check if a cover image is provided
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('cover/'), $imageName);
            $post->cover = $imageName; // Only set if a cover image is uploaded
        } else {
            // Set a default cover image if none is provided
            $post->cover = 'default_cover_image.jpg'; // Replace with your default image path
        }

        $post->save();

        return redirect()->route('index')->with('success', 'Post submitted for approval.');
    }
 
    public function edit($id)
    {
        $post = Post::findOrFail($id); // Fetch the post by ID
        return view('edit', compact('post')); // Pass the post variable to the view
    }
 
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'body' => 'required|string',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Allow null for cover
        ]);

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->author = $request->author;
        $post->body = $request->body;

        // Check if a cover image is provided
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('cover/'), $imageName);
            $post->cover = $imageName; // Update cover if a new one is uploaded
        }

        $post->save();

        return redirect()->route('index')->with('success', 'Post updated successfully.');
    }
 
    public function destroy($id)
    {
        $post = Post::findOrFail($id); // Find the post by ID
        $post->delete(); // Delete the post

        return redirect()->route('index')->with('success', 'Post deleted successfully.');
    }
 
    public function deleteimage($id){
        $images=Image::findOrFail($id);
        if (File::exists("images/".$images->image)) {
           File::delete("images/".$images->image);
        }
 
       Image::find($id)->delete();
       return back();
    }
 
    public function deletecover($id){
        $cover=Post::findOrFail($id)->cover;
        if (File::exists("cover/".$cover)) {
            File::delete("cover/".$cover);
        }
        return back();
    }
 
}