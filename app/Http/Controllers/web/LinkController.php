<?php

namespace App\Http\Controllers\web;

use App\Models\Link;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class LinkController extends Controller
{
    public function redirect(string $address): RedirectResponse
    {
        $link = Link::query()->where('shorten_link', $address)->first();
        if (is_null($link)) {
            abort(404);
        }
        return redirect($link->main_link);
    }
}
