<?php


namespace App\Http\Classes\Interfaces\Validations\Marca;


use Illuminate\Http\Request;

interface ValidateRequestMarca
{
    public function request(Request $request):array;
}
