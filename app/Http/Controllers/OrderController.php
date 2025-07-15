<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.product')->where('user_id', Auth::id())->latest()->get();
        return response()->json($orders);
    }
    public function  store(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',

            'address.full_name' => 'required|string|max:255',
            'address.phone' => 'required|regex:/^\+7\s\(\d{3}\)\s\d{3}-\d{2}-\d{2}$/',
            'address.city' => 'required|string',
            'address.street' => 'required|string',
            'address.house' => 'required|string',
            'address.apartment' => 'nullable|string',
            'address.comments' => 'nullable|string',
        ]);

        return DB::transaction(function () use ($validated) {
            $total = 0;
            $productsToUpdate  = [];

            foreach ($validated['items'] as $item) {
                $product = \App\Models\Product::lockForUpdate()->findOrFail($item['product_id']);

                // Проверка, хватает ли товара
                if ($product->stock < $item['quantity']) {
                    abort(400, "Недостаточно товара: {$product->name}");
                }

                $productsToUpdate[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                ];

                $total += $product->price * $item['quantity'];
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'total_price' => round($total, 2),
                'status' => 'pending',
            ]);

            foreach ($productsToUpdate as $item) {
                $product = $item['product'];
                $quantity = $item['quantity'];

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                ]);

                $product->decrement('stock', $quantity);
            }

            Address::create(array_merge(
                $validated['address'],
                ['order_id' => $order->id]
            ));

            return response()->json([
                'message' => 'Заказ создан успешно',
                'order' => $order->load('items.product'),
            ], 201);
        });
    }
}
