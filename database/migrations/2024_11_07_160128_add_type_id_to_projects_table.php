<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {

            //  creo la colonna type_id-> 
            $table->unsignedBigInteger('type_id')->nullable();
            // aggiungi la foreign key  sulla colonna  type_id
            $table->foreign('type_id')
                    ->references('id')
                    ->on('types'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            //  per cancellare  la colonna devo preima cancellare il vincolo della foreign key 
            // $table->$table->dropForeign('projects_type_id_foreignn');

            // oppure cancello l'indice di una tabella specifica mettendo in un array
            $table->dropForeign(['type_id']);
            $table->dropColumn('type_id');

        });
    }
};
