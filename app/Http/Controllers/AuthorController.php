<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;

class AuthorController extends Controller
{
    public function show(User $user)
    {
        $articles = Article::where('user_id', $user->id)
            ->where('status', 'published')
            ->with(['category', 'author'])
            ->latest()
            ->paginate(8);

        $publishedCount = Article::where('user_id', $user->id)
            ->where('status', 'published')
            ->count();

        return view('author-profile', compact('user', 'articles', 'publishedCount'));
    }
}
