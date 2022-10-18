<?php


namespace App\Http\Classes\Interfaces\Validations\Auth;


use Illuminate\Http\Request;

interface iValidationsRequestAuth
{
    public function validate(Request $request): array;
}
