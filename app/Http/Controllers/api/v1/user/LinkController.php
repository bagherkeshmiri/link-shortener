<?php

namespace App\Http\Controllers\api\v1\user;

use App\Http\Controllers\api\Traits\ApiResponder;
use App\Http\Controllers\Controller;
use App\Repositories\Link\LinkRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
     */
    public function shorten(Request $request)
    {
        $data = [
            'main_link' => $request->input('link'),
            'shorten_link' => '/'.$this->generateLink(),
            'user_id' => 1
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
