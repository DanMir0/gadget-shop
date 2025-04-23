<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductStatus;
use Illuminate\Http\Request;

class ProductStatusController extends Controller
{
    public function getNewProducts()
    {
        $status = ProductStatus::where('name', 'new')->first();

        $newProducts = Product::where('status_id', $status->id)->get()->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'stock' => $product->stock,
                'image' => asset('storage/' . $product->image), // ✅ Формируем URL изображения
            ];
        });

        return response()->json($newProducts);
    }
}
