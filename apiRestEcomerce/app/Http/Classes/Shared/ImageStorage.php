<?php


namespace App\Http\Classes\Shared;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

final class ImageStorage
{
    public function save(Request $request, $disk, $nameImage): array
    {
        if ($request->hasFile('image')) {
            $archivo = $request->file('image');
            $nombreArchivo = $archivo->getClientOriginalName();
            $nombreArchivo = str_replace(" ", "_", $nombreArchivo);
            $ext = $archivo->getClientOriginalExtension();
            $nameImage = str_replace(" ", "_", $nameImage) . "." . $ext;
            Storage::disk($disk)->put($nameImage, File::get($archivo));
            return ['image' => $nameImage, 'error' => false];
        } else {
            return ['error' => true];
        }
    }
}
