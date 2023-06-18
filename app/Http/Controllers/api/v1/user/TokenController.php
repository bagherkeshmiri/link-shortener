<?php

namespace App\Http\Controllers\api\v1\user;

use App\Http\Controllers\api\Traits\ApiResponder;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    use ApiResponder;

    public function generateToken(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);

        $user = User::query()->where('email', $request->input('email'))->first();
        if (is_null($user)) {
            return $this->notFoundRespond();
        }

        try {
            $token = $user->createToken('api_key', ['*'], now()->addMonths(6));
            return $this->successWithDataRespond([$token->accessToken->name => $token->plainTextToken], 'عملیات موفق');
        } catch (Exception) {
            return $this->errorRespond('خطا در عملیات');
        }
    }
}
