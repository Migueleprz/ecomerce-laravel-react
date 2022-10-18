<?php

namespace App\Http\Controllers\Categorias;

use App\Http\Classes\Core\Categoria\Categorias;
use App\Http\Classes\Interfaces\CRUDHttp;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoriaController extends Controller implements CRUDHttp
{
    private Categorias $categorias;

    public function __construct(Categorias $categorias)
    {
        $this->categorias = $categorias;
    }

    //
    public function index(): JsonResponse
    {
        $data = $this->categorias->list();
        return response()->json($data['data'], $data['status']);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $this->categorias->save($request);
        return response()->json($data['data'], $data['status']);
    }

    public function show(int $id): JsonResponse
    {
        $data = $this->categorias->get($id);
        return response()->json($data['data'], $data['status']);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $data = $this->categorias->edit($request, $id);
        return response()->json($data['data'], $data['status']);
    }

    public function destroy(int $id): JsonResponse
    {
        $data = $this->categorias->delete($id);
        return response()->json($data['data'], $data['status']);
    }
}
