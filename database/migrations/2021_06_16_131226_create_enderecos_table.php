<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();

            $table->string('logradouro', 180);
            $table->string('numero', 20);

            $table->char('cep', 8)->nullable();

            $table->string('complemento', 100)->nullable();

            $table->string('cidade', 20);
            $table->string('estado', 20);

            $table->double('latitude', 11, 7);
            $table->double('longitude', 11, 7);

            $table->foreignId('acampamento_id')
                ->constrained('acampamentos')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('enderecos');
    }
}
