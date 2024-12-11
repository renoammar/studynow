<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('TodoList.index', compact('posts'));
    }

    public function create()
    {
        return view('TodoList.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Post::create($request->all());
        return redirect()->route('TodoList.index');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('TodoList.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->all());
        return redirect()->route('TodoList.index');
    }

    public function destroy($id)
{
    
    $post = Post::findOrFail($id);
    $post->delete();


    return redirect()->route('TodoList.index')->with('success', 'Post deleted successfully!');
}

}
