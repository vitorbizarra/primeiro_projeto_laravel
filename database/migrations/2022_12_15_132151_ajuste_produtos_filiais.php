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
        // Criando tabela filiais
        Schema::create('filiais', function (Blueprint $table) {
            $table->id();
            $table->string('filial', 30);
            $table->timestamps();
        });

        // Criando tabela produto_filiais
        Schema::create('produto_filiais', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('filial_id');
            $table->unsignedBigInteger('produto_id');
            $table->double('preco_venda', 8, 2);
            $table->integer('estoque_minimo');
            $table->integer('estoque_maximo');
            $table->timestamps();

            $table->foreign('filial_id')->references('id')->on('filiais');
            $table->foreign('produto_id')->references('id')->on('produtos');
        });

        // Removendo colunas da tabela produtos
        Schema::table('produtos', function (Blueprint $table) {
            $table->dropColumn([
                'preco_venda',
                'estoque_minimo',
                'estoque_maximo'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Adicionando colunas na tabela produtos
        Schema::table('produtos', function (Blueprint $table) {
            $table->double('preco_venda', 8, 2)->after('peso');
            $table->integer('estoque_minimo')->after('preco_venda');
            $table->integer('estoque_maximo')->after('estoque_minimo');
        });

        Schema::dropIfExists('produto_filiais');

        Schema::dropIfExists('filiais');
    }
};
