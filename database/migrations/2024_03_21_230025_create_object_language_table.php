<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('object_language', function (Blueprint $table) {
            $table->unsignedBigInteger('object_id');
            $table->foreignId('language_id')->constrained();
            $table->integer('type');
            $table->primary([
                'object_id',
                'language_id',
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('object_language');
    }
};
