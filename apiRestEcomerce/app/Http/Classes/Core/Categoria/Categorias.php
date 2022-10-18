<?php


namespace App\Http\Classes\Core\Categoria;


use App\Http\Classes\Interfaces\CRUD;
use App\Http\Classes\Validations\ValidateRequestCategoria;
use App\Models\Categoria;
use Illuminate\Http\Request;

class Categorias implements CRUD
{
    private ValidateRequestCategoria $validate;
    private Categoria $categoria;

    public function __construct(ValidateRequestCategoria $validate, Categoria $categoria)
    {
        $this->validate = $validate;
        $this->categoria = $categoria;
    }

    public function list(): array
    {
        try {
            return ['data' => $this->categoria->all(), 'error' => false, 'status' => 200];

        } catch (\Exception $e) {
            return ['data' => $e->getMessage(), 'error' => true, 'status' => 500];
        }
    }

    public function save(Request $request): array
    {
        try {
            $data = $this->validate->validate($request);
            if ($data['error']) {
                return ['data' => $data['errors'], 'status' => 400];
            }
            $this->categoria =  $this->categoria->create([
                'nombre' => ucfirst($request->nombre)
            ]);
            return ['data' => 'Categoria: '.$this->categoria->nombre.' creada!', 'error' => false, 'status' => 200];

        } catch (\Exception $e) {
            return ['data' => $e->getMessage(), 'error' => true, 'status' => 500];
        }
    }

    public function get(int $id): array
    {
        try {
            return ['data' => $this->categoria->find($id), 'error' => false, 'status' => 200];

        } catch (\Exception $e) {
            return ['data' => $e->getMessage(), 'error' => true, 'status' => 500];

        }
    }

    public function edit(Request $request, int $id): array
    {
        $data = $this->validate->validate($request);
        if ($data['error']) {
            return ['data' => $data['errors'], 'status' => 400];
        }
        try {
            $this->categoria = $this->categoria->find($id);
            $this->categoria->nombre = ucfirst($request->nombre);
            $this->categoria->save();

            return ['data' => 'Categoria actualizada!', 'error' => false, 'status' => 200];

        } catch (\Exception $e) {
            return ['data' => $e->getMessage(), 'error' => true, 'status' => 500];
        }
    }

    public function delete(int $id): array
    {
        try {
            $this->categoria->find($id);
            $this->categoria->delete();
            return ['data' => 'Categoria eliminada', 'error' => false, 'status' => 200];

        } catch (\Exception $e) {
            return ['data' => $e->getMessage(), 'error' => true, 'status' => 500];

        }
    }
}
