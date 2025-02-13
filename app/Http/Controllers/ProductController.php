<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Hapus middleware ini jika belum ada sistem login
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // Menampilkan daftar produk
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
            'criteria' => 'required|in:perorangan,rombongan',
            'favorite' => 'boolean'
        ]);

        $product = Product::create($request->all());

        return response()->json([
            'message' => 'Produk berhasil ditambahkan!',
            'product' => $product
        ], 201);
    }

    // Menampilkan detail produk
    public function show(Product $product)
    {
        return response()->json($product);
    }

    // Mengupdate produk
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
            'criteria' => 'required|in:perorangan,rombongan',
            'favorite' => 'boolean'
        ]);

        $product->update($request->all());

        return response()->json([
            'message' => 'Produk berhasil diperbarui!',
            'product' => $product
        ]);
    }

    // Menghapus produk
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'message' => 'Produk berhasil dihapus!'
        ]);
    }
}
