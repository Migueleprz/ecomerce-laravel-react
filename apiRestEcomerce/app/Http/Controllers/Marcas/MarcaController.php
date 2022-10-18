<?php

namespace App\Http\Controllers\Marcas;

use App\Http\Classes\Core\Marca\Marcas;
use App\Http\Classes\Interfaces\CRUDHttp;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class MarcaController extends Controller implements CRUDHttp
{
    private Marcas $marcas;

    public function __construct(Marcas $marcas)
    {
        $this->marcas = $marcas;
    }

    //
    public function index(): JsonResponse
    {
        $data = $this->marcas->list();
        return response()->json($data['data'], $data['status']);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $this->marcas->save($request);
        return response()->json($data['data'], $data['status']);
    }

    public function show(int $id): JsonResponse
    {
        $data = $this->marcas->get($id);
        return response()->json($data['data'], $data['status']);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $data = $this->marcas->edit($request, $id);
        return response()->json($data['data'], $data['status']);
    }

    public function destroy(int $id): JsonResponse
    {
        $data = $this->marcas->delete($id);
        return response()->json($data['data'], $data['status']);
    }
}
