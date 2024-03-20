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
        Schema::create('courriers', function (Blueprint $table) {
            $table->id();
            $table->string("reference",9)->unique();
            $table->date("date_reçu")->nullable();
            $table->date("date_envoyer")->nullable();
            $table->string("destinateur",70);
            $table->string("lieu_destinateur",250);
            $table->text("objet")->nullable();
            $table->string("commentaire",250)->nullable();
            $table->text('files')->nullable();
            $table->string("courrier_statue",250);
            $table->softDeletes();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courriers');
    }
};
