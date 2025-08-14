<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Product;
use App\Models\ProductStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function edit()
    {
        return view('welcome');
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name.ru' => 'required|string|max:255',
            'name.en' => 'required|string|max:255',
            'description.ru' => 'nullable|string',
            'description.en' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'category_id' => 'required|exists:categories,id',
            'status_id' => 'required|exists:product_status,id',
        ], [
            'name.ru.required' => 'Название на русском обязательно.',
            'name.en.required' => 'Название на английском обязательно.',
            'price.required' => 'Цена обязательна.',
            'category_id.required' => 'Выберите категорию.',
            'image.image' => 'Файл должен быть изображением.',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::exists('public/' . $product->image)) {
                Storage::delete('public/' . $product->image);
            }

            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        } else {
            $data['image'] = $product->image;
        }

        $product->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'stock' => $data['stock'],
            'image' => $data['image'],
            'category_id' => $data['category_id'],
            'status_id' => $data['status_id'],
        ]);

        return response()->json([
            'message' => 'Ок',
            'product' => $product
        ]);
    }

    public function getProduct($id)
    {
        $product = Product::with(['category', 'status'])->find($id);

        if (!$product) {
            return response()->json(['message' => 'Товар не найден'], 404);
        }
        return response()->json($product);
    }

    public function getCategories()
    {
        $categories = Categorie::all();
        return response()->json($categories);
    }

    public function getStatuses()
    {
        $statuses = ProductStatus::all();
        return response()->json($statuses);
    }

    public function create()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name.ru' => 'required|string|max:255',
            'name.en' => 'required|string|max:255',
            'description.ru' => 'nullable|string',
            'description.en' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'category_id' => 'required|exists:categories,id',
            'status_id' => 'required|exists:product_status,id',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product = Product::create([
            'name' => [
                'ru' => $validated['name']['ru'],
                'en' => $validated['name']['en'],
            ],
            'description' => [
                'ru' => $validated['description']['ru'],
                'en' => $validated['description']['en'],
            ],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'image' => $imagePath,
            'category_id' => $validated['category_id'],
            'status_id' =>  $validated['status_id'],
        ]);

        return response()->json($product);
    }
}
