<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'slug' => 'required|string|max:50',
        ]);

        $category = Categorie::create([
            'name' => $validated['name'],
            'slug' => $validated['slug'],
        ]);

        return response()->json($category);
    }

    public function edit() {
        return view('welcome');
    }

    public function getCategory($id)
    {
        $category = Categorie::find($id);

        if (!$category) {
            return response()->json(['message' => 'Товар не найден'], 404);
        }

        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $category = Categorie::findOrFail($id);

        $validated = $request->validate([
           'name' => 'required|string|max:50',
           'slug' => 'required|string|max:50',
        ], [
            'slug.required' => 'Слаг должен быть обязательно.'
        ]);

        $category->update([
           'name' => $validated['name'],
           'slug' => $validated['slug'],
        ]);

        return response()->json([
            'message' => 'Ок',
            'product' => $category
        ]);
    }
}
