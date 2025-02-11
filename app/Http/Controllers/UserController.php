<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function getUser(Request $request): JsonResponse
    {   $token =$request->bearerToken();
        return response()->json([
            'status' => 'success',
            'user' => $request->user(), // Mengambil data user yang sedang login
            'token' => $token // **Tambahkan token di response**

        ]);
    }
}
