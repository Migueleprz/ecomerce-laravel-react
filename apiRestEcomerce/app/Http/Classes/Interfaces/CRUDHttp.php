<?php


namespace App\Http\Classes\Interfaces;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface CRUDHttp
{
    public function index():JsonResponse;

    public function store(Request $request):JsonResponse;

    public function show(int $id):JsonResponse;

    public function update(Request $request, int $id):JsonResponse;

    public function destroy(int $id):JsonResponse;

}
