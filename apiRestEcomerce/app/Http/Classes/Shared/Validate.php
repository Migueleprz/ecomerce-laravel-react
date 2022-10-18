<?php


namespace App\Http\Classes\Shared;
use App\Http\Classes\Interfaces\Validations\ValidateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Validate implements ValidateRequest
{
    public function requestValidator(Request $request, array $rules, array $messages): array
    {
        $validated = Validator::make($request->all(), $rules, $messages);
        if ($validated->fails()) {
            return [
                'error' => true,
                'errors' => $validated->errors()
            ];
        }
        return ['error' => false];
    }
}
