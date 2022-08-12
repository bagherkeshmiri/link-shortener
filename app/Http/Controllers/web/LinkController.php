<?php

namespace App\Http\Controllers\web;

use Exception;
use App\Models\Link;
use App\Http\Controllers\Controller;
use App\Repositories\Link\LinkRepositoryInterface;

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
    public function transmitter(Link $link)
    {
        try {
            return redirect($link->main_link);
        } catch (Exception $error){
            dd($error);
        }
    }
}
