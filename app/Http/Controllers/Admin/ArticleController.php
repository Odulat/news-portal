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
                'text'       => 'required',
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
}
