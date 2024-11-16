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
            $table->string('file')
                   ->nullable() 
                //    ->nullable serve per non avere una relazione per forza quindi non avere un type id per ogni campo dela tabella projects ma opzionale
                   ->after('type_id') 
                   ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            
            if (Schema::hasColumn('projects', 'file')) {

                $table->dropColumn('file');

            }
        });
    }
};
