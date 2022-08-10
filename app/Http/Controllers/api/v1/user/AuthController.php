<?php

namespace App\Http\Controllers\api\v1\user;

use App\Http\Controllers\api\Traits\ApiResponder;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\v1\user\auth\userRegisterRequest;
use App\Repositories\User\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use OpenApi\Annotations as OA;

class AuthController extends Controller
{
    use ApiResponder;

    protected object $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }




    /**
     * @OA\Post(
     * path="/register",
     * tags={"Auth"},
     * summary="register user",
     * description="register user ",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *   required={"name","family","email","password"},
     * @OA\Property(property="name", type="string"),
     * @OA\Property(property="family", type="string"),
     * @OA\Property(property="email", type="email"),
     * @OA\Property(property="password", type="string"),
     * )
     *         )
     *     ),
     * @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="message",type="string", default="عملیات موفق"),
     *                  @OA\Property(property="success",type="boolean", default="true")
     *              )
     *          )
     *      ),
     * @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="error", type="object",
     *                      @OA\Property(property="code", type="number",default="400"),
     *                      @OA\Property(property="details",type="string")
     *                  ),
     *                  @OA\Property(property="message",type="string", default="خطا در عملیات"),
     *                  @OA\Property(property="success",type="boolean", default="false")
     *              )
     *          )
     *      ),
     *
     * @OA\Response(
     *          response=404,
     *          description="Not Found ",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="error", type="object",
     *                      @OA\Property(property="code", type="number",default="404"),
     *                      @OA\Property(property="details",type="string")
     *                  ),
     *                  @OA\Property(property="message",type="string", default="رکورد مورد نظر یافت نشد"),
     *                  @OA\Property(property="success",type="boolean", default="false")
     *              )
     *          )
     *      ),
     *   )
     */
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
