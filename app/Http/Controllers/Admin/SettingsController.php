<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('articles')->get();
        $user = Auth::user();

        return view('admin.settings', compact('categories', 'user'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:500'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            if ($user->avatar && ! str_starts_with($user->avatar, 'data:') && Storage::disk('public')->exists($user->avatar)) {
                try {
                    Storage::disk('public')->delete($user->avatar);
                } catch (\Throwable $e) {
                    // Ignore deletion error
                }
            }
            try {
                if (env('VERCEL') || ! is_writable(storage_path('app/public'))) {
                    $validated['avatar'] = 'data:'.$file->getMimeType().';base64,'.base64_encode(file_get_contents($file->getRealPath()));
                } else {
                    $validated['avatar'] = $file->store('avatars', 'public');
                }
            } catch (\Throwable $e) {
                $validated['avatar'] = 'data:'.$file->getMimeType().';base64,'.base64_encode(file_get_contents($file->getRealPath()));
            }
        }

        $user->update($validated);

        return redirect()->route('admin.settings')->with('success', 'Profile and avatar updated successfully.');
    }
}
