<?php


namespace App\Http\Classes\Interfaces;


use Illuminate\Http\Request;

interface CRUD
{
    public function list():array;

    public function save(Request $request):array;

    public function get(int $id):array;

    public function edit(Request $request, int $id):array;

    public function delete(int $id):array;
}
