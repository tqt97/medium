<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function __invoke()
    {
        $posts = Post::with('user')
            ->latest()
            ->paginate(3);

        return view('home', [
            'posts' => $posts,
        ]);
    }
}
