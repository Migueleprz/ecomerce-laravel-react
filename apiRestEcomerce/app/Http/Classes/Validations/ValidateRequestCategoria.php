<?php


namespace App\Http\Classes\Validations;



use App\Http\Classes\Interfaces\Validations\Categoria\ValidateRequestCategorias;
use App\Http\Classes\Shared\Validate;
use Illuminate\Http\Request;


final class ValidateRequestCategoria implements ValidateRequestCategorias
{
    private Validate $validate;

    public function __construct(Validate $validate)
    {
        $this->validate = $validate;
    }

    public function validate(Request $request): array
    {
        $rules = [
            'nombre' => 'required'
        ];
        $messages = [
            'nombre.required' => 'El nombre de la categoria es requerido!'
        ];
        return $this->validate->requestValidator($request, $rules, $messages);
    }
}
