<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Post;


class PostController extends Controller
{
    public function index() 
    {
        return view('posts.index', [
            'posts' => Post::latest()->filter(
                request(['search', 'category', 'author'])
                )->paginate(18)->withQueryString()
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]); 
    }

    public function create() 
    {
        return view('posts.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('posts', 'slug')],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'user_id' => ['required', Rule::exists('users', 'id')]
        ]);
        $attributes['published_time'] = 10;
        Post::create($attributes);

        return redirect('/');
    }

    public function update(Post $post)
    {
        // $post -> published_time = 10;
        // $post -> save();

        $attributes = request()->validate([
            'title' => 'required',
            'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post->id)],
            'excerpt' => 'required',
             'body' => '',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);
        $post -> update($attributes);
        return redirect('/');
        // return view('posts.update', [
        //     'post' => $post
        // ]);       
        
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect('/');
    }


}
