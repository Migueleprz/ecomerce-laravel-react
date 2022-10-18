<?php


namespace App\Http\Classes\Core\Marca;


use App\Http\Classes\Interfaces\CRUD;
use App\Http\Classes\Shared\ImageStorage;
use App\Http\Classes\Validations\ValidationRequestMarca;
use App\Models\Marca;
use Illuminate\Http\Request;

class Marcas implements CRUD
{
    private ValidationRequestMarca $validationRequestMarca;
    private Marca $marca;
    private ImageStorage $imageStorage;

    public function __construct(
        ValidationRequestMarca $validationRequestMarca,
        Marca $marca,
        ImageStorage $imageStorage
    )
    {
        $this->validationRequestMarca = $validationRequestMarca;
        $this->marca = $marca;
        $this->imageStorage = $imageStorage;
    }

    public function list(): array
    {
        try {
            return ['data' => $this->marca->all(), 'status' => 200];
        } catch (\Exception $e) {
            return ['data' => $e->getMessage(), 'error' => true, 'status' => 500];
        }
    }

    public function save(Request $request): array
    {
        $validate = $this->validationRequestMarca->request($request);
        if ($validate['error']) {
            return ['data' => $validate['errors'], 'status' => 400];
        }
        try {
            $marcaNombre = ucfirst($request->nombre);
            $imageName = $this->imageStorage->save($request, "marcas", $marcaNombre);

            if ($imageName['error']) {
                return ['data' => 'La imagen de la marca es requerida', 'status' => 400];
            }

            $this->marca = $this->marca->create([
                'nombre' => $marcaNombre,
                'image' => $imageName['image']
            ]);
            return ['data' => 'Marca: ' . $marcaNombre . ' creada!', 'status' => 200];

        } catch (\Exception $e) {
            return ['data' => $e->getMessage(), 'error' => true, 'status' => 500];
        }
    }

    public function get(int $id): array
    {
        try {
            return ['data' => $this->marca->find($id), 'status' => 200];

        } catch (\Exception $e) {
            return ['data' => $e->getMessage(), 'error' => true, 'status' => 500];
        }
    }

    public function edit(Request $request, int $id): array
    {
        $validate = $this->validationRequestMarca->request($request);
        if ($validate['error']) {
            return ['data' => $validate['errors'], 'status' => 400];
        }

        try {
            $imageName = $this->imageStorage->save($request, "marcas", $request->nombre);
            $this->marca = $this->marca->find($id);
            $this->marca->nombre = $request->nombre;
            if ($imageName['error']) {
                $this->marca->save();
                return ['data' => 'Marca: ' . $this->marca->nombre . ' actualizada!', 'status' => 200];
            } else {
                $this->marca->image = $imageName['image'];
                $this->marca->save();
                return ['data' => 'Marca: ' . $this->marca->nombre . ' actualizada!', 'status' => 200];
            }

        } catch (\Exception $e) {
            return ['data' => $e->getMessage(), 'error' => true, 'status' => 500];
        }
    }

    public function delete(int $id): array
    {
        try {
            $this->marca = $this->marca->find($id);
            $this->marca->delete();
            return ['data' => 'Marca: ' . $this->marca->nombre . ' eliminada', 'status' => 200];

        } catch (\Exception $e) {
            return ['data' => $e->getMessage(), 'error' => true, 'status' => 500];
        }
    }
}
