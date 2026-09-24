<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'published');
        $status = $tab === 'drafts' ? 'draft' : 'published';

        $articles = Article::where('user_id', Auth::id())
            ->where('status', $status)
            ->with(['category', 'author'])
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $publishedCount = Article::where('user_id', Auth::id())
            ->where('status', 'published')
            ->count();

        $draftsCount = Article::where('user_id', Auth::id())
            ->where('status', 'draft')
            ->count();

        return view('admin.articles.index', compact('articles', 'tab', 'publishedCount', 'draftsCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'content' => ['required', 'string'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            try {
                if (env('VERCEL') || ! is_writable(storage_path('app/public'))) {
                    $thumbnailPath = 'data:'.$file->getMimeType().';base64,'.base64_encode(file_get_contents($file->getRealPath()));
                } else {
                    $thumbnailPath = $file->store('thumbnails', 'public');
                }
            } catch (\Throwable $e) {
                $thumbnailPath = 'data:'.$file->getMimeType().';base64,'.base64_encode(file_get_contents($file->getRealPath()));
            }
        }

        $isDraft = $request->input('action') === 'draft';
        $status = $isDraft ? 'draft' : 'published';

        Article::create([
            'user_id' => Auth::id(),
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']).'-'.Str::random(5),
            'thumbnail' => $thumbnailPath,
            'content' => $validated['content'],
            'status' => $status,
            'published_at' => $isDraft ? null : now(),
        ]);

        $message = $isDraft ? 'Article saved as draft successfully!' : 'Article published successfully!';
        $redirectRoute = $isDraft
            ? redirect()->route('articles.index', ['tab' => 'drafts'])
            : redirect()->route('articles.index');

        return $redirectRoute->with('success', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::all();

        return view('admin.articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'content' => ['required', 'string'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            if ($article->thumbnail && ! str_starts_with($article->thumbnail, 'data:') && Storage::disk('public')->exists($article->thumbnail)) {
                try {
                    Storage::disk('public')->delete($article->thumbnail);
                } catch (\Throwable $e) {
                    // Ignore deletion error in read-only environment
                }
            }
            try {
                if (env('VERCEL') || ! is_writable(storage_path('app/public'))) {
                    $article->thumbnail = 'data:'.$file->getMimeType().';base64,'.base64_encode(file_get_contents($file->getRealPath()));
                } else {
                    $article->thumbnail = $file->store('thumbnails', 'public');
                }
            } catch (\Throwable $e) {
                $article->thumbnail = 'data:'.$file->getMimeType().';base64,'.base64_encode(file_get_contents($file->getRealPath()));
            }
        }

        $isDraft = $request->input('action') === 'draft';
        $status = $isDraft ? 'draft' : 'published';

        $article->title = $validated['title'];
        $article->slug = Str::slug($validated['title']).'-'.Str::random(5);
        $article->category_id = $validated['category_id'];
        $article->content = $validated['content'];
        $article->status = $status;
        if (! $isDraft && ! $article->published_at) {
            $article->published_at = now();
        }
        $article->save();

        $message = $isDraft ? 'Article updated and saved as draft!' : 'Article updated and published successfully!';
        $redirectRoute = $isDraft
            ? redirect()->route('articles.index', ['tab' => 'drafts'])
            : redirect()->route('articles.index');

        return $redirectRoute->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);

        if ($article->thumbnail && Storage::disk('public')->exists($article->thumbnail)) {
            Storage::disk('public')->delete($article->thumbnail);
        }

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully!');
    }
}
