<?php


namespace App\Http\Classes\Interfaces\Validations;


use Illuminate\Http\Request;

interface ValidateRequest
{
    public function requestValidator(Request $request, array $rules, array $messages): array;

}
