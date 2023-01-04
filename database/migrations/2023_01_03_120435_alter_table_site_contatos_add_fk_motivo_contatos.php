<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        // Criando a coluna da fk
        Schema::table('site_contatos', function(Blueprint $table){
            $table->unsignedBigInteger('motivo_contatos_id');
        });
        
        // Atribuindo motivo_contato para a nova coluna motivo_contato_id
        DB::statement("UPDATE site_contatos SET motivo_contatos_id = motivo_contato");

        // Criando a fk e removendo a coluna motivo_contato
        Schema::table('site_contatos', function(Blueprint $table){
            $table->foreign('motivo_contatos_id')->references('id')->on('motivo_contatos');
            $table->dropColumn('motivo_contato');
        });
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Criando a coluna motivo_contato e removendo a fk
        Schema::table('site_contatos', function(Blueprint $table){
            $table->integer('motivo_contato');
            $table->dropForeign('site_contatos_motivo_contatos_id_foreign');
        });

         // Atribuindo motivo_contato para a nova coluna motivo_contato_id
        DB::statement("UPDATE site_contatos SET motivo_contato = motivo_contatos_id");

        // Excluíndo a coluna da fk
        Schema::table('site_contatos', function(Blueprint $table){
            $table->dropColumn('motivo_contatos_id');
        });
    }
};