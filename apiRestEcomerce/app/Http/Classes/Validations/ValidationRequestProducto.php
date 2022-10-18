<?php


namespace App\Http\Classes\Validations;


use App\Http\Classes\Interfaces\Validations\Producto\ValidateRequestProducto;
use App\Http\Classes\Shared\Validate;
use Illuminate\Http\Request;

final class ValidationRequestProducto implements ValidateRequestProducto
{
    private Validate $validate;

    public function __construct(Validate $validate)
    {
        $this->validate = $validate;
    }

    public function request(Request $request): array
    {
        $rules = [
            'nombre' => 'required',
            'categoria_id' => 'required|integer',
            'image' => 'required|file',
            'precio' => 'required|integer',
            'stock' => 'required|integer',
            'marca_id' => 'required|integer',
            'sex_id' => 'required|integer',
            'descripcion' => 'required',
        ];
        $messages = [
            'nombre.required' => 'El nombre del producto es requerido!',
            'categoria_id.required' => 'La categoría es requerida!',
            'categoria_id.integer' => 'La categoría no es valida!',
            'image.required' => 'La imagen del producto es requerida!',
            'image.file' => 'La imagen es requerida',
            'precio.required' => 'El precio es requerido!',
            'precio.integer' => 'El precio no es valido!',
            'stock.required' => 'El stock es requerido!',
            'stock.integer' => 'El stock no es valido!',
            'marca_id.required' => 'La marca es requerida!',
            'marca_id.integer' => 'La Marca no es valida!',
            'sex_id.required' => 'El sexo del Producto es requerido!',
            'sex_id.integer' => 'El sexo del producto no es valido!',
            'descripcion.required' => 'La descripcion es requerida',
        ];
        return $this->validate->requestValidator($request, $rules, $messages);
    }

    public function requestUpdate(Request $request): array
    {
        $rules = [
            'nombre' => 'required',
            'categoria_id' => 'required|integer',
            'precio' => 'required|integer',
            'stock' => 'required|integer',
            'marca_id' => 'required|integer',
            'sex_id' => 'required|integer',
            'descripcion' => 'required',
        ];
        $messages = [
            'nombre.required' => 'El nombre del producto es requerido!',
            'categoria_id.required' => 'La categoría es requerida!',
            'categoria_id.integer' => 'La categoría no es valida!',
            'precio.required' => 'El precio es requerido!',
            'precio.integer' => 'El precio no es valido!',
            'stock.required' => 'El stock es requerido!',
            'stock.integer' => 'El stock no es valido!',
            'marca_id.required' => 'La marca es requerida!',
            'marca_id.integer' => 'La Marca no es valida!',
            'sex_id.required' => 'El sexo del Producto es requerido!',
            'sex_id.integer' => 'El sexo del producto no es valido!',
            'descripcion.required' => 'La descripcion es requerida',
        ];
        return $this->validate->requestValidator($request, $rules, $messages);
    }
}
