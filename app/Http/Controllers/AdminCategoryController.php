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
}
