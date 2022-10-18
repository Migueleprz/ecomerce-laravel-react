<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'slug_nombre',
        'categoria_id',
        'image',
        'image_path',
        'precio',
        'stock',
        'marca_id',
        'sex_id',
        'descripcion',
        'disponible',
    ];

    public function categorias():BelongsTo
    {
      return  $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function marcas():BelongsTo
    {
       return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function sex():BelongsTo
    {
       return $this->belongsTo(Sex::class, 'sex_id');
    }
}
