<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function getOrders()
    {

        $orders = Order::with([
            'user',
            'address',
            'items.product'
        ])->get();

        return response()->json($orders);
    }

    public function destroy($id)
    {
        $order = Order::find($id);

        if ($order) {
            $order->delete();
        }
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|string'
        ]);

        if ($order->status !== $validated['status']) {
            $order->update([
                'status' => $validated['status']
            ]);
            return response()->json(['message' => 'Статус обновлен']);
        }

        return response()->json(['message' => 'Статус не изменился']);
    }
}
