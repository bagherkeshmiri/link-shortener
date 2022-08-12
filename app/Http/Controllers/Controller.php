<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;


/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Link Shortener Api Documentation",
 * )
 *
 *
 * @OA\Server(
 *      url="http://localhost:8000/api/v1/",
 * )
 *
 *
 * @OA\SecurityScheme(
 *       scheme="bearer",
 *       securityScheme="Bearer",
 *       type="http",
 *       bearerFormat="JWT",
 *       in="header",
 *       name="Authorization",
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
