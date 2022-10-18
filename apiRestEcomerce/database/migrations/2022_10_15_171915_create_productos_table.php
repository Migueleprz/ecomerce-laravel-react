<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',80)->unique();
            $table->string('slug_nombre',80);
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->string('image',80);
            $table->string('image_path',100);
            $table->integer('precio');
            $table->integer('stock');
            $table->foreignId('marca_id')->constrained('marcas');
            $table->foreignId('sex_id')->constrained('sexes');
            $table->text('descripcion');
            $table->boolean('disponible')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
};
