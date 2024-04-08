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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('job_title');
            $table->string('district', 100);
            $table->string('city', 100);
            $table->integer('remote');
            $table->boolean('is_parttime');
            $table->integer('min_salary')->unsigned();
            $table->integer('max_salary')->unsigned();
            $table->integer('currency_salary')->default(1);
            $table->text('requirement')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->integer('number_applicants')->unsigned()->default(0);
            $table->integer('status')->default(0);
            $table->string('slug')->unique();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('company_id')->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
