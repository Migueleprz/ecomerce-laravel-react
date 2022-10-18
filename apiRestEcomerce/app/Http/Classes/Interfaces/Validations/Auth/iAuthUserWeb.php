<?php


namespace App\Http\Classes\Interfaces\Validations\Auth;


use Illuminate\Http\Request;

interface iAuthUserWeb
{
    public function login(Request $request):array;
}
