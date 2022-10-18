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
        Schema::create('web_users', function (Blueprint $table) {
            $table->id();
            $table->string('nuip',20);
            $table->string('nombres',50);
            $table->string('apellidos',50);
            $table->string('ciudad',50);
            $table->string('direccion',150);
            $table->string('telefono',50);
            $table->string('email',80)->unique();
            $table->string('password');
            $table->string('image',100)->default('default.png');
            $table->string('image_path',100)->default('/default/');
            $table->foreignId('role_id')->default(1)->constrained('roles');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('web_users');
    }
};
