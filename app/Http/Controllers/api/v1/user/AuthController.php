<?php

namespace App\Http\Controllers\api\v1\user;

use App\Http\Controllers\api\Traits\ApiResponder;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\user\auth\userRegisterRequest;
use App\Repositories\User\UserRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    use ApiResponder;

    protected object $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function register(userRegisterRequest $request)
    {
        $data = [
            'name' => $request->input('name'),
            'family' => $request->input('family'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        DB::beginTransaction();
        try{
            $this->userRepository->create($data);
            DB::commit();
            return $this->successWithoutDataRespond('عملیات موفق');
        } catch(Exception $error){
            DB::rollBack();
            return $this->errorRespond('خظا در عملیات');
        }
    }
}
