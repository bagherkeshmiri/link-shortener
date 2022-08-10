<?php

use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 * path="/api/v1/register",
 * tags={"User Auth"},
 * summary="register user",
 * description="register user ",
 *     @OA\RequestBody(
 *         @OA\MediaType(
 *             mediaType="multipart/form-data",
 *             @OA\Schema(
 *   required={"name","family","email","password"},
 * @OA\Property(property="name", type="string"),
 * @OA\Property(property="family", type="string"),
 * @OA\Property(property="email", type="nubmer"),
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
 *                  @OA\Property(property="message",type="string", default="کاربر با موفقیت ثبت نام شد"),
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
 */
