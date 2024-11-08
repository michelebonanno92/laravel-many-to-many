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

            // //  creo la colonna type_id-> 
            // $table->unsignedBigInteger('type_id')->nullable()->after('slug');

            // // aggiungo la foreign key  sulla colonna  type_id
            // $table->foreign('type_id')
            //         ->references('id')
            //         ->on('types'); 

            // oppure scrivendolo in una sola riga 
            $table->foreignId('type_id')
                   ->nullable() 
                   ->after('slug') 
                   ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {

            if (Schema::hasColumn('projects', 'type_id')) {

                //  per cancellare  la colonna devo prima cancellare il vincolo della foreign key altrimenti non posso droppare(cancellare) la colonna 
                // $table->$table->dropForeign('projects_type_id_foreignn');
                // oppure cancello l'indice di una tabella specifica mettendo in un array
                $table->dropForeign(['type_id']);
                // e poi droppo(cancelo) la colonna
                $table->dropColumn('type_id');

            }
  

        });
    }
};
