<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcampamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acampamentos', function (Blueprint $table) {
            $table->id();

            $table->string('nome_local', 120);

            $table->string('foto_principal', 180);

            $table->text('descricao');

            $table->double('preco_1', 11, 2);
            $table->double('preco_2', 11, 2);

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
        Schema::dropIfExists('acampamentos');
    }
}
