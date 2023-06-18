<?php

namespace App\Http\Controllers\api\v1\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TokenController extends Controller
{

    public function generateToken(Request $request): jsonResponse
    {
        $request->validate([
            'email' => 'required',
        ]);

        $user = User::query()->where('email', $request->input('email'))->first();
        if (is_null($user)) {
            return responseError([
                'message' => __('messages.user_not_found')
            ]);
        }

        try {
            $token = $user->createToken('api_key', ['*'], now()->addMonths(6));
        } catch (Exception) {
            return responseError();
        }
        return responseSuccess([
            'data' => [
                $token->accessToken->name => $token->plainTextToken,
            ]
        ]);
    }
}
