<?php

namespace App\Http\Controllers\Producto;

use App\Http\Classes\Core\Productos\Productos;
use App\Http\Classes\Interfaces\CRUDHttp;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class ProductoController extends Controller implements CRUDHttp
{
    private Productos $productos;

    public function __construct(Productos $productos)
    {
        $this->productos = $productos;
    }

    //
    public function index(): JsonResponse
    {
        $data = $this->productos->list();
        return response()->json($data['data'], $data['status']);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $this->productos->save($request);
        return response()->json($data['data'], $data['status']);
    }

    public function show(int $id): JsonResponse
    {
        $data = $this->productos->get($id);
        return response()->json($data['data'], $data['status']);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $data = $this->productos->edit($request, $id);
        return response()->json($data['data'], $data['status']);
    }

    public function destroy(int $id): JsonResponse
    {
        $data = $this->productos->delete($id);
        return response()->json($data['data'], $data['status']);
    }
}
