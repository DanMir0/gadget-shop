<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

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

    public function getCart()
    {
        $userId = auth()->id();

        $cartItems = Cart::select('p.name', 'p.price', 'p.description', 'p.stock', 'p.image', 'c.quantity', 'c.user_id', 'c.product_id')
            ->from('cart as c')
            ->join('products as p', 'c.product_id', '=', 'p.id')
            ->where('c.user_id', $userId)
            ->get();
//        where('user_id', $userId)
//            ->select('id', 'user_id', 'product_id', 'quantity')
//            ->get();
        return response()->json($cartItems);
    }
}
