<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Repositories\Link\LinkRepositoryInterface;
use Exception;

class LinkController extends Controller
{
    protected object $linkRepository;


    public function __construct(LinkRepositoryInterface $linkRepository)
    {
        $this->linkRepository = $linkRepository;
    }


    /**
     * redirect short link if exist to main link
     * @param $link
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\never
     */
    public function transmitter($link)
    {
        $link = $this->linkRepository->getModel()->where('shorten_link','/'.$link)->first();
        try {
            return redirect($link->main_link);
        } catch (Exception $error){
            dd($error);
           return abort(404);
        }
    }
}
