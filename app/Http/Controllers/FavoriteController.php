<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $favorites = $user->favorites()->get();
        return response()->json($favorites);
    }

    public function getProducts(Request $request)
    {
        $user = $request->user();

        $favoriteQuery = $user->favorites()->getQuery();

        $perPage = $request->query('per_page', 8);
        $favorites = $favoriteQuery->paginate($perPage);

        $favorites->getCollection()->transform(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'stock' => $product->stock,
                'image' => asset('storage/' . $product->image),
            ];
        });
        return response()->json($favorites);
    }

    public function toggle(Request $request, Product $product)
    {
        $user = $request->user();

        if ($user->favorites()->where('product_id', $product->id)->exists()) {
            $user->favorites()->detach($product->id);
            return response()->json(['favorited' => false]);
        } else {
            $user->favorites()->attach($product->id);
            return response()->json(['favorited' => true]);
        }
    }
}
