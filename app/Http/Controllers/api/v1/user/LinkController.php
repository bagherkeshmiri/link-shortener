<?php

namespace App\Http\Controllers\api\v1\user;

use App\Models\Link;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\LinksResource;

class LinkController extends Controller
{
    public function generateLink(): string
    {
        $shorten_link = Str::random(10);
        while (Link::query()->select(['shorten_link'])->where('shorten_link', $shorten_link)->first()) {
            $shorten_link = Str::random(10);
        }
        return $shorten_link;
    }

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
        } catch (Exception) {
            DB::rollBack();
            return responseSuccess();
        }
        return responseSuccess();
    }

    public function all(): jsonResponse
    {
        $data = LinksResource::collection(auth()->user()->links);
        return responseSuccess([
            'data' => $data,
        ]);
    }
}
