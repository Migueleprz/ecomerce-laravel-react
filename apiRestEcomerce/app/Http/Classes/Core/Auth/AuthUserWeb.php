<?php


namespace App\Http\Classes\Core\Auth;

use App\Http\Classes\Interfaces\Validations\Auth\iAuthUserWeb;
use App\Http\Classes\Validations\ValidationRequestAuth;
use App\Models\WebUser;
use Illuminate\Http\Request;

class AuthUserWeb implements iAuthUserWeb
{
    private ValidationRequestAuth $validate;
    private WebUser $user;

    public function __construct(ValidationRequestAuth $validate, WebUser $user)
    {
        $this->validate = $validate;
        $this->user = $user;
    }

    public function login(Request $request): array
    {
        $validar = $this->validate->validate($request);
        if ($validar['error']) {
            return [
                'data' => $validar['errors'],
                'status' => 400
            ];
        }
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $this->user = $this->user->find(auth()->user()->id);
            $data = [
                'token' => auth()->user()->createToken('authUser')->accessToken,
                'sub' => $this->user->id,
                'user' => $this->user->nombres . ' ' . $this->user->apellidos,
                'role' => $this->user->roles->nombre,
                'roleId' => $this->user->roles->id,
            ];
            return [
                'data' => $data,
                'status' => 200,
                'error' => false
            ];
        }
        return [
            'data' => 'Credenciales Incorrectas',
            'status' => 404,
            'error' => true
        ];

    }
}
