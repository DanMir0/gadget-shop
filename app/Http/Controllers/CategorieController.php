<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function getCategories()
    {
        $categories = Categorie::all();

        return response()->json($categories);
    }
}
