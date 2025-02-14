<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:sanctum'); // Menggunakan token untuk autentikasi
    // }

    // GET /orders (Menampilkan semua order)
    public function index()
    {
        $orders = Order::with('orderItems')->get();
        return response()->json($orders);
    }

    // POST /orders (Membuat order baru)
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'transaction_time' => 'required|date',
            'total_price' => 'required|integer',
            'total_item' => 'required|integer',
            'payment_amount' => 'required|integer',
            'cashier_id' => 'required|exists:users,id',
            'cashier_name' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $order = Order::create($validatedData);
        return response()->json(['message' => 'Order created successfully!', 'order' => $order], 201);
    }

    // GET /orders/{id} (Menampilkan detail order berdasarkan ID)
    public function show($id)
    {
        $order = Order::with('orderItems')->find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        return response()->json($order);
    }

    // PUT/PATCH /orders/{id} (Memperbarui data order)
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $validatedData = $request->validate([
            'transaction_time' => 'sometimes|date',
            'total_price' => 'sometimes|integer',
            'total_item' => 'sometimes|integer',
            'payment_amount' => 'sometimes|integer',
            'cashier_id' => 'sometimes|exists:users,id',
            'cashier_name' => 'sometimes|string',
            'payment_method' => 'sometimes|string',
        ]);

        $order->update($validatedData);
        return response()->json(['message' => 'Order updated successfully!', 'order' => $order]);
    }

    // DELETE /orders/{id} (Menghapus order berdasarkan ID)
    public function destroy($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        $order->delete();
        return response()->json(['message' => 'Order deleted successfully!']);
    }
}
