<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $search = request()->query('search');

        $articles = Article::with('author')
            ->when($search, function ($query) use ($search) {
                return $query->where('title', 'like', "%$search%")->orWhere('content', 'like', "%$search%");
            })
            ->paginate(12);

        return view('pages.main.articles', compact('articles'));
    }

    public function show(Article $article)
    {
        $article = Article::with('author')->where('id', $article->id)->first();

        $anotherArticles = Article::where('id', '!=', $article->id)->inRandomOrder()->limit(4)->get();

        if (!$article) {
            return abort(404, 'Data not found');
        }

        return view('pages.main.detail-article', compact('article', 'anotherArticles'));
    }
}
