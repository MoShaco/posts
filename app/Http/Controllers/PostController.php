<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class PostController extends Controller
{
    public function index() {

        $posts = Post::all(); // Select * from posts

        return view('posts.index', ['posts' => $posts]);
    }

    public function show(Post $post) {

        return view('posts.show', ['post' => $post]);

    }

    public function create() {
        $users = User::all();

        return view('posts.create', ['users' => $users]);
    }

    public function store(Request $request) {
        
        $request->validate([
            'title' => ['required', 'max:20'],
            'description' => ['required', 'min:10', 'max:120'],
            'city' => ['required','max:20'],
            'post_creator' => ['required', 'exists:users,id'],
        ]);

        $title = $request->title;
        $description = $request->description;
        $city = $request->city;
        $postBy = $request->post_creator;

        Post::create([
            'title' => $title,
            'description' => $description,
            'city' => $city,
            'user_id' => $postBy,
        ]);

        return to_route('posts.index');
    }

    public function edit(Post $post) {

        $users = User::all();

        return view('posts.edit', ['users' => $users, 'post' => $post]);

    }

    public function update($postId) {

        // Validate user input
        $request = request();
        $request->validate([
            'title' => ['required','max:20'],
            'description' => ['required', 'min:10', 'max:120'],
            'city' => ['required','max:20'],
            'post_creator' => ['required', 'exists:users,id'],
        ]);
        // Get the data the user provide
        $title = $request->title;
        $description = $request->description;
        $city = $request->city;
        $postsBy = $request->post_creator;
        
        // Update the post
        $post = Post::findOrFail($postId);
        $post->update([
            'title' => $title,
            'description' => $description,
            'city' => $city,
            'user_id' => $postsBy,
        ]);

        // Shwo the page after updating
        return to_route('posts.show', $postId);

    }

    public function destroy(Post $post) {

        $post->delete();
        return to_route('posts.index');
    }

    public function search(Request $request) {

        $request->validate([
            'keyword' => ['nullable', 'string'],
        ]);
        
        $searchKeyword = htmlspecialchars(strip_tags($request->keyword));

        // Handle the case when the input is empty,return all posts
        if (empty($searchKeyword)) {
            $posts = Post::all();
        } else {
            // Show only the posts that match the searching keyword
            $posts = Post::where('description', 'like', "%$searchKeyword%")->get();
        }

        return view('posts.search_results', ['posts' => $posts]);
    }
}
