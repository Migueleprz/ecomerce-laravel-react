<?php


namespace App\Http\Classes\Interfaces\Validations\Producto;


use Illuminate\Http\Request;

interface ValidateRequestProducto
{
    public function request(Request $request):array;

    public function requestUpdate(Request $request):array;


}
