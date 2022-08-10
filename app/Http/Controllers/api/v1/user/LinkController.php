<?php

namespace App\Http\Controllers\api\v1\user;

use App\Http\Controllers\api\Traits\ApiResponder;
use App\Http\Controllers\Controller;
use App\Repositories\Link\LinkRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use OpenApi\Annotations as OA;



/**
 * @OA\Post(
 * path="/tokens/create",
 * tags={"Tokens"},
 * summary="Create Token For Registered User",
 * description="Create Token For Registered User ",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *   required={"email","password"},
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
 *                  @OA\Property(property="data", type="object",
 *                      @OA\Property(property="api_key", type="string",default="16|rYLBNvAAdtrXuGpM1WEQbIntRcC2iF5B2BD9SJsL"),
 *                  ),
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
 *   )
 *
 *

 */




class LinkController extends Controller
{
    use ApiResponder;

    protected object $linkRepository;


    /**
     * generate shorten the link address
     * @return string
     */
    public function generateLink()
    {
        $shorten_link = Str::random(10);
        while($this->linkRepository->getModel()->where('shorten_link',$shorten_link)->first()){
            $shorten_link = Str::random(10);
        }
        return $shorten_link;
    }


    public function __construct(LinkRepositoryInterface $linkRepository)
    {
        $this->linkRepository = $linkRepository;

    }


    /**
     * store shorten link in links table
     * @param Request $request
     * @return JsonResponse
     *
     *
     *
     * /**
     * @OA\Get(
     * path="/link/shorten?link=your-link",
     * tags={"Links"},
     * summary="Shorten Link",
     * description="Shorten Link",
     * security={{"Bearer ":{}}},
     *
     *     @OA\Parameter(
     *          name="link",
     *          in="query",
     *          required=true,
     *          description="your link for shorten",
     *          @OA\Schema(
     *              type="string"
     *          ),
     *     ),
     * @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="data", type="object",
     *                      @OA\Property(property="main-link", type="string",default="https://www.zoomit.ir/tech-iran/384961-protection-of-childrens-online-data-neglected-in-iran/"),
     *                      @OA\Property(property="shorten_link", type="string",default="http://localhost:8000/EUhylqvfMI"),
     *                  ),
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
     * @OA\Response(
     *          response=404,
     *          description="Not Found",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="error", type="object",
     *                      @OA\Property(property="code", type="number",default="404"),
     *                      @OA\Property(property="details",type="string")
     *                  ),
     *                  @OA\Property(property="message",type="string", default="کاربر مورد نظر یافت نشد"),
     *                  @OA\Property(property="success",type="boolean", default="false")
     *              )
     *          )
     *      ),
     * @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="message",type="string", default="Unauthenticated"),
     *              )
     *          )
     *      ),
     *   )
     */
    public function shorten(Request $request)
    {
        $data = [
            'main_link' => $request->input('link'),
            'shorten_link' => '/'.$this->generateLink(),
            'user_id' => Auth::guard('api')->user()->id
        ];
        DB::beginTransaction();
        try{
            $this->linkRepository->create($data);
            DB::commit();
            return $this->successWithDataRespond( [ 'main-link' => $data['main_link'] , 'shorten_link' => url('').$data['shorten_link'] ],'عملیات موفق');
        } catch(Exception $error){
            DB::rollBack();
            return $this->errorRespond('خظا در عملیات');
        }
    }
}
