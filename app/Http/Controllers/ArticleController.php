<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('pages.articles.index', compact('articles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $slug = Str::slug($request->title);
            // check if slug already exists
            $slugCount = Article::where('slug', $slug)->count();
            if ($slugCount > 0) {
                $slug = $slug . '-' . time();
            }

            $fileService = new FileService();

            $imagePath = $fileService->uploadFile($request->file('image_path'), 'file/article');

            Article::create([
                'title' => $request->title,
                'slug' => $slug,
                'content' => $request->content,
                'image_path' => config('app.url') . $imagePath,
                'is_published' => true,
                'author_id' => auth()->id(),
            ]);

            return redirect()->route('admin.articles.index')->with('success', 'Article created successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.articles.index')->with('failed', 'Failed to create article');
        }
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            // if title not same with the current title, update the slug
            if ($request->title != $article->title) {
                $slug = Str::slug($request->title);
                // check if slug already exists
                $slugCount = Article::where('slug', $slug)->count();
                if ($slugCount > 0) {
                    $slug = $slug . '-' . time();
                }
            } else {
                $slug = $article->slug;
            }

            $fileService = new FileService();

            if ($request->hasFile('image_path')) {
                $imagePath = $fileService->uploadFile($request->file('image_path'), 'file/article');
                
            }

            $article->update([
                'title' => $request->title,
                'slug' => $slug,
                'content' => $request->content,
                'is_published' => true,
                'author_id' => auth()->id(),
                'image_path' => $request->hasFile('image_path') ? config('app.url') . $imagePath : $article->image_path,
            ]);

            return redirect()->route('admin.articles.index')->with('success', 'Article updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.articles.index')->with('failed', 'Failed to update article');
        }
    }

    public function destroy(Article $article)
    {
        try {
            $article->delete();
            return redirect()->back()->with('success', 'Article deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('failed', 'Failed to delete article');
        }
    }
}
