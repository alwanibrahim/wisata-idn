<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {   
        //*untuk meanmpilkan data
        $categories = Category::all();
        return ResponseHelper::sendResponse('success', 'Data categories', $categories);
    }

    public function store(Request $request)
    {   
        //*untuk menyimpan
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories'
        ]);

        if ($validator->fails()) {
            return ResponseHelper::sendResponse('error', 'Validasi gagal', $validator->errors(), 400);
        }

        $category = Category::create(['name' => $request->name]);
        return ResponseHelper::sendResponse('success', 'Kategori berhasil ditambahkan', $category, 201);
    }

    public function show($id)
    {   
        //* untuk show(menunjukkan )
        $category = Category::find($id);
        if (!$category) {
            return ResponseHelper::sendResponse('error', 'Kategori tidak ditemukan', null, 404);
        }
        return ResponseHelper::sendResponse('success', 'Detail kategori', $category);
    }

    public function update(Request $request, $id)
    {   
        //*untuk mengubah atau edit
        $category = Category::find($id);
        if (!$category) {
            return ResponseHelper::sendResponse('error', 'Kategori tidak ditemukan', null, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name,' . $id
        ]);

        if ($validator->fails()) {
            return ResponseHelper::sendResponse('error', 'Validasi gagal', $validator->errors(), 400);
        }

        $category->update(['name' => $request->name]);
        return ResponseHelper::sendResponse('success', 'Kategori berhasil diperbarui', $category);
    }

    public function destroy($id)
    {   
        //*untuk delete atau destroy
        $category = Category::find($id);
        if (!$category) {
            return ResponseHelper::sendResponse('error', 'Kategori tidak ditemukan', null, 404);
        }

        $category->delete();
        return ResponseHelper::sendResponse('success', 'Kategori berhasil dihapus', null);
    }
}
