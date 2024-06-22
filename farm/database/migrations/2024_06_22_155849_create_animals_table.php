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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('age');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('race_id');
            $table->text('description');
            $table->enum('status', ['en vente', 'vendu'])->default('en vente');
            $table->decimal('price', 10, 2);
            $table->json('pictures')->nullable();
            $table->timestamps();
        
            $table->foreign('type_id')->references('id')->on('types');
            $table->foreign('race_id')->references('id')->on('races');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
