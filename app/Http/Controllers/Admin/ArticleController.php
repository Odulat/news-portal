<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $categories = Category::query()
            ->get();

        return view('admin.article.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'title'      => 'required|string|max:255',
                'text'       => 'required|max:500',
                'image'      => 'required|image',
            ]
        );

        try {
            DB::beginTransaction();

            $validatedData['image'] = $request->file('image')->store('images');

            $article = Article::query()
                ->create($validatedData);

            $article->categories()
                ->sync($request->get('categories'));

            DB::commit();

            return redirect(route('index'));
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error(
                'Server error',
                [
                    'message' => $exception->getMessage(),
                    'trace'   => Str::limit(
                        $exception->getTraceAsString(), 200
                    ),
                ]
            );

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('admin.article.form', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
                               'title' => 'required|string|max:255',
                               'text' => 'required|string',
                               'image' => 'nullable|image',
                               'categories' => 'array|nullable'
                           ]);

        $article->title = $request->title;
        $article->text = $request->text;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $article->image = $request->file('image')->store('images', 'public');
        }

        $article->save();
        $article->categories()->sync($request->categories);

        return redirect()->route('index')->with('success', 'Article updated successfully!');
    }

    public function destroy(Article $article)
    {
        // Delete image if exists
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->categories()->detach();
        $article->delete();

        return redirect()->route('index')->with('success', 'Article deleted successfully!');
    }
}
