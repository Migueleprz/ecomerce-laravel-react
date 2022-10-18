<?php


namespace App\Http\Classes\Interfaces\Validations\Categoria;


use Illuminate\Http\Request;

interface ValidateRequestCategorias
{
    public function validate(Request $request):array;
}
