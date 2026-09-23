<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::where('status', 'published')
            ->with(['category', 'author'])
            ->latest();

        $articles = $query->paginate(6)->withQueryString();
        $categories = Category::all();

        return view('home', compact('articles', 'categories'));
    }

    public function show(string $slug)
    {
        $article = Article::with(['category', 'author'])
            ->where('slug', $slug)
            ->firstOrFail();

        if ($article->status === 'draft' && (! Auth::check() || Auth::id() !== $article->user_id)) {
            abort(404);
        }

        return view('article-detail', compact('article'));
    }
}
