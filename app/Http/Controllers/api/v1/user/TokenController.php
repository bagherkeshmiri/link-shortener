<?php

namespace App\Http\Controllers\api\v1\user;

use App\Http\Controllers\api\Traits\ApiResponder;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    use ApiResponder;

    protected object $userRepository;


    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function generateToken(Request $request)
    {
        $user = $this->userRepository->getModel()->where('email',$request->input('email'))->first();
        if(is_null($user)){
            return $this->notFoundRespond();
        }
        try {
            $token = $user->createToken('api_key',['*'],now()->addMonths(6));
            return $this->successWithDataRespond( [ $token->accessToken->name => $token->plainTextToken ] ,'عملیات موفق');
        } catch(Exception $error){
            return $this->errorRespond('خطا در عملیات');
        }
    }
}
