<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.form');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|string|max:255',
            ]
        );

        try {
            DB::beginTransaction();

            Category::query()
                ->create($validatedData);

            DB::commit();
            return redirect(route('admin.index'));
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
