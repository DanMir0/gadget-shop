<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function postCart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1']
        ]);

        $userId = auth()->id();

        $existingCart = Cart::where('user_id', $userId)->where('product_id', $validated['product_id'])->first();

        if ($existingCart) {
            $existingCart->quantity = $validated['quantity'];
            $existingCart->save();
            return response()->json($existingCart);
        }

        $cart = new Cart([
            'user_id' => $userId,
            'product_id' => $validated['product_id'],
            'quantity' => $validated['quantity'],
        ]);

        $cart->save();
        return response()->json($cart);
    }

    public function decreaseCart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
        ]);

        $userId = auth()->id();

        $cart = Cart::where('user_id', $userId)
            ->where('product_id', $validated['product_id'])
            ->first();

        if (!$cart) {
            return response()->json(['message' => 'Product not found in cart'], 404);
        }

        // Уменьшаем количество
        $cart->quantity--;

        if ($cart->quantity <= 0) {
            $cart->delete();
            return response()->json(['message' => 'Product removed from cart']);
        }

        $cart->save();
        return response()->json($cart);
    }

    public function getCart(Request $request)
    {
        $userId = auth()->id();
        $lang = $request->query('lang', 'ru');

        $cartItems = DB::table('cart')
            ->where('user_id', $userId)
            ->get();

        $products = \App\Models\Product::whereIn('id', $cartItems->pluck('product_id'))->get()->keyBy('id');

        $result = $cartItems->map(function ($item) use ($products, $lang) {
            $product = $products[$item->product_id] ?? null;

            if (!$product) return null;

            $cleanImagePath = ltrim(trim($product->image, " \t\n\r\0\x0B\"'"), '/');

            return [
                'id' => $product->id,
                'name' => $product->name[$lang] ?? $product->name['ru'] ?? '',
                'description' => $product->description[$lang] ?? $product->description['ru'] ?? '',
                'price' => $product->price,
                'stock' => $product->stock,
                'image' => asset('storage/' . $cleanImagePath),
                'quantity' => $item->quantity,
            ];
        })->filter();

        return response()->json($result);
    }

}
