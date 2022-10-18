<?php


namespace App\Http\Classes\Validations;



use App\Http\Classes\Interfaces\Validations\Auth\iValidationsRequestAuth;
use App\Http\Classes\Shared\Validate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

final class ValidationRequestAuth implements iValidationsRequestAuth
{
    private Validate $validate;

    public function __construct(Validate $validate)
    {
        $this->validate = $validate;
    }

    public function validate(Request $request): array
    {
        $rules = [
            'email' => 'required|email|unique:web_users,email' . $request->id,
            'password' => 'required'
        ];
        $messages = [
            'email.required' => 'El email es requerido!',
            'email.email' => 'El email no es valido!',
            'email.unique' => 'El email esta en uso!',
            'password.required' => 'La contraseña es requerida!',
        ];
        return $this->validate->requestValidator($request, $rules, $messages);
    }
}
