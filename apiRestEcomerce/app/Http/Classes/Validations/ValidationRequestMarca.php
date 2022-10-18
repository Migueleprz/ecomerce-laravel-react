<?php


namespace App\Http\Classes\Validations;



use App\Http\Classes\Interfaces\Validations\Marca\ValidateRequestMarca;
use App\Http\Classes\Shared\Validate;
use Illuminate\Http\Request;

final class ValidationRequestMarca implements ValidateRequestMarca
{
    private Validate $validate;

    public function __construct(Validate $validate)
    {
        $this->validate = $validate;
    }

    public function request(Request $request): array
    {
        $rules = [
            'nombre' => 'required'
        ];
        $messages = [
            'nombre.required' => 'El nombre de la marca es requerido!'
        ];
        return $this->validate->requestValidator($request, $rules, $messages);
    }
}
