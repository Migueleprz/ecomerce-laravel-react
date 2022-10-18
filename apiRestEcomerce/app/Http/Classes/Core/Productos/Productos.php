<?php


namespace App\Http\Classes\Core\Productos;


use App\Http\Classes\Interfaces\CRUD;
use App\Http\Classes\Shared\ImageStorage;
use App\Http\Classes\Validations\ValidationRequestProducto;
use App\Models\Producto;
use http\Env\Url;
use Illuminate\Http\Request;

class Productos implements CRUD
{
    private Producto $producto;
    private ValidationRequestProducto $validationRequestProducto;
    private ImageStorage $imageStorage;

    public function __construct(
        Producto $producto,
        ValidationRequestProducto $validationRequestProducto,
        ImageStorage $imageStorage
    )
    {
        $this->producto = $producto;
        $this->validationRequestProducto = $validationRequestProducto;
        $this->imageStorage = $imageStorage;
    }

    public function list(): array
    {
        try {
            return ['data' => $this->producto->with(['categorias','marcas','sex'])->get(), 'error' => false, 'status' => 200];
        } catch (\Exception $e) {
            return ['data' => $e->getMessage(), 'error' => true, 'status' => 500];
        }
    }

    public function save(Request $request): array
    {
        $validar = $this->validationRequestProducto->request($request);
        if ($validar['error']) {
            return ['data' => $validar['errors'], 'status' => 400];
        }
        try {
            $productoNombre = ucfirst($request->nombre);
            $disk = "productos";
            $imageName = $this->imageStorage->save($request, $disk, $productoNombre);

            $this->producto = $this->producto->create([
                'nombre' => $productoNombre,
                'slug_nombre' => strtolower(str_replace(' ', '_', $productoNombre)),
                'categoria_id' => $request->categoria_id,
                'image' => $imageName['image'],
                'image_path' => env('APP_URL').'/'.$disk.'/',
                'precio' => $request->precio,
                'stock' => $request->stock,
                'marca_id' => $request->marca_id,
                'sex_id' => $request->sex_id,
                'descripcion' => $request->descripcion,
                'disponible' => true,
            ]);
            return ['data' => 'Producto: ' . $productoNombre . ' creado!', 'status' => 200];
        } catch (\Exception $e) {
            return ['data' => $e->getMessage(), 'error' => true, 'status' => 500];
        }
    }

    public function get(int $id): array
    {
        try {
            $data = $this->producto->where(['id'=> $id])->with(['categorias','marcas','sex'])->get();
            if(!$data[0]){
                return ['data' => 'Producto no encontrado' , 'status' => 404];
            }
            return ['data' => $data[0] , 'status' => 200];
        } catch (\Exception $e) {
            return ['data' => $e->getMessage(), 'error' => true, 'status' => 500];
        }
    }

    public function edit(Request $request, int $id): array
    {
        $validar = $this->validationRequestProducto->requestUpdate($request);
        if ($validar['error']) {
            return ['data' => $validar['errors'], 'status' => 400];
        }
        try {
            $productoNombre = ucfirst($request->nombre);
            $imageName = $this->imageStorage->save($request, "productos", $productoNombre);
            $this->producto = $this->producto->find($id);
            if ($imageName['error']) {
                $this->producto->nombre = $productoNombre;
                $this->producto->slug_nombre = strtolower(str_replace(' ', '_', $productoNombre));
                $this->producto->categoria_id = $request->categoria_id;
                $this->producto->precio = $request->precio;
                $this->producto->stock = $request->stock;
                $this->producto->marca_id = $request->marca_id;
                $this->producto->sex_id = $request->sex_id;
                $this->producto->descripcion = $request->descripcion;
                $this->producto->disponible = true;
                $this->producto->save();
                return ['data' => 'Producto: ' . $this->producto->nombre . ' actualizado!', 'status' => 200];
            } else {
                $this->producto->nombre = $productoNombre;
                $this->producto->slug_nombre = strtolower(str_replace(' ', '_', $productoNombre));
                $this->producto->categoria_id = $request->categoria_id;
                $this->producto->image = $imageName['image'];
                $this->producto->precio = $request->precio;
                $this->producto->stock = $request->stock;
                $this->producto->marca_id = $request->marca_id;
                $this->producto->sex_id = $request->sex_id;
                $this->producto->descripcion = $request->descripcion;
                $this->producto->disponible = true;
                $this->producto->save();
                return ['data' => 'Producto: ' . $this->producto->nombre . ' actualizado!', 'status' => 200];
            }

        } catch (\Exception $e) {
            return ['data' => $e->getMessage(), 'error' => true, 'status' => 500];
        }
    }

    public function delete(int $id): array
    {
        try {
            $this->producto = $this->producto->find($id);
            $this->producto->delete();
            return ['data' => 'Producto: ' . $this->producto->nombre . ' Eliminado!', 'status' => 200];
        } catch (\Exception $e) {
            return ['data' => $e->getMessage(), 'error' => true, 'status' => 500];
        }
    }
}
