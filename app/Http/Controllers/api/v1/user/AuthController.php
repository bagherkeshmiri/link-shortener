<?php

namespace App\Http\Controllers\api\v1\user;

use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function register(Request $request): jsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string',
            'family' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);
        DB::beginTransaction();
        try {
            User::query()->create($data);
            DB::commit();
        } catch (Exception) {
            DB::rollBack();
            return responseError();
        }
        return responseSuccess();
    }
}
