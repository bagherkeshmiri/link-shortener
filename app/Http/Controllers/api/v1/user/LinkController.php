<?php

namespace App\Http\Controllers\api\v1\user;

use App\Models\Link;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\LinksResource;
use App\Http\Controllers\api\Traits\ApiResponder;

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
 * security={
 *   {"Authorization":{}}
 *     },
 *   )
 */
class LinkController extends Controller
{
    use ApiResponder;

    public function generateLink(): string
    {
        $shorten_link = Str::random(10);
        while (Link::query()->select(['shorten_link'])->where('shorten_link', $shorten_link)->first()) {
            $shorten_link = Str::random(10);
        }
        return $shorten_link;
    }

    /**
     * @OA\Get(
     * path="/link/shorten?link=your-link",
     * tags={"Links"},
     * security={{ "Bearer":{} }},
     * summary="Shorten Link",
     * description="Shorten Link",
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
    public function shorten(Request $request): jsonResponse
    {
        $request->validate([
            'link' => 'required',
        ]);

        $data = [
            'main_link' => $request->input('link'),
            'shorten_link' => $this->generateLink(),
            'user_id' => auth()->user()->id,
        ];

        DB::beginTransaction();
        try {
            Link::query()->create($data);
            DB::commit();
            $result = [
                'link' => $data['main_link'],
                'shorten_link' => url('') . '/' . $data['shorten_link'],
            ];
            return $this->successWithDataRespond($result, __('messages.successful_operation'));
        } catch (Exception) {
            DB::rollBack();
            return $this->errorRespond('خظا در عملیات');
        }
    }

    /**
     *
     * @OA\Get(
     * path="/link/all",
     * tags={"Links"},
     * summary="Show All Links",
     * description="Show All Links",
     * security={{ "Bearer":{} }},
     *
     * @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  @OA\Property(property="data", type="object",
     *                      @OA\Property(property="main-link", type="string",default="https://www.zoomit.ir/tech-iran/384961-protection-of-childrens-online-data-neglected-in-iran/"),
     *                      @OA\Property(property="shorten_link", type="string",default="http://localhost:8000/EUhylqvfMI"),
     *                      @OA\Property(property="created_at", type="string",default="2022-08-12 11:12:25"),
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
    public function all(): jsonResponse
    {
        $data = LinksResource::collection(auth()->user()->links);
        return $this->successWithDataRespond($data, 'عملیات موفق');
    }
}
