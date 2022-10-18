<?php


namespace App\Http\Controllers\Auth;


use App\Http\Classes\Core\Auth\AuthUserWeb;
use App\Http\Classes\Interfaces\Validations\Auth\iAuthHttp;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller implements iAuthHttp
{
    private AuthUserWeb $userWeb;

    public function __construct(AuthUserWeb $userWeb)
    {
        $this->userWeb = $userWeb;
    }

    public function login(Request $request): JsonResponse
    {
        $data = $this->userWeb->login($request);
        return response()->json($data['data'], $data['status']);
    }
}
