<?php


namespace App\Http\Classes\Interfaces\Validations\Categoria;


use Illuminate\Http\Request;

interface ValidateRequest
{
    public function request(Request $request):array;
}
