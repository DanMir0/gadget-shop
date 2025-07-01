<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function  store(Request $request)
    {
        $data = $request->validate([
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:product,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        return response()->json(['message' => 'Закакз успешно оформлен']);
    }
}
