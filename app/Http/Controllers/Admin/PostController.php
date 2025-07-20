<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.posts.form', [
            'post' => new Post,
            'categories' => Category::active()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $post = Post::create($data);

        if ($request->hasFile('image')) {
            $post->addMediaFromRequest('image')->toMediaCollection('posts');
        }

        return redirect()->route('admin.posts.edit', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post): View
    {
        return view('admin.posts.form', [
            'post' => $post,
            'categories' => Category::active()->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        if ($post->user_id !== auth()->user()->id) {
            abort(403);
        }
        $data = $request->validated();
        $post->update($data);
        if ($request->hasFile('image')) {
            $post->addMediaFromRequest('image')->toMediaCollection('posts');

        }

        return redirect()->route('admin.posts.edit', ['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        if ($post->user_id !== auth()->user()->id) {
            abort(403);
        }
        $post->delete();

        return to_route('home');
    }
}
