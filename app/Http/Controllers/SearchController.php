<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $exploreArticles = Article::where('status', 'published')
            ->with(['category', 'author'])
            ->latest()
            ->take(3)
            ->get();

        $query = Article::where('status', 'published')
            ->with(['category', 'author'])
            ->latest();

        if ($request->filled('q')) {
            $term = $request->q;
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', '%'.$term.'%')
                    ->orWhere('content', 'like', '%'.$term.'%')
                    ->orWhereHas('author', function ($authorQuery) use ($term) {
                        $authorQuery->where('name', 'like', '%'.$term.'%')
                            ->orWhere('email', 'like', '%'.$term.'%');
                    });
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $hasSearch = $request->filled('q') || $request->filled('category');
        $articles = $hasSearch ? $query->paginate(6)->withQueryString() : collect();

        return view('search', compact('categories', 'exploreArticles', 'articles', 'hasSearch'));
    }
}
