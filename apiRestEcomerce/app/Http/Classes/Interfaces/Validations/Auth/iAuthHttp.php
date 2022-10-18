<?php


namespace App\Http\Classes\Interfaces\Validations\Auth;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface iAuthHttp
{
    public function login(Request $request):JsonResponse;
}
