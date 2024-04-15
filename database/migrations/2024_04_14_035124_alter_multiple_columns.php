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
        Schema::table('posts', function (Blueprint $table) {
            if (Schema::hasColumn('posts', 'district')) {
                $table->string('district')->nullable()->change();
            }
            if (Schema::hasColumn('posts', 'remote')) {
                $table->integer('remote')->nullable()->change();
            }
            if (Schema::hasColumn('posts', 'is_parttime')) {
                $table->boolean('is_parttime')->nullable()->change();
            }
            if (Schema::hasColumn('posts', 'min_salary')) {
                $table->integer('min_salary')->nullable()->change();
            }
            if (Schema::hasColumn('posts', 'max_salary')) {
                $table->integer('max_salary')->nullable()->change();
            }
            if (Schema::hasColumn('posts', 'currency_salary')) {
                $table->integer('currency_salary')->nullable()->change();
            }
            if (Schema::hasColumn('posts', 'start_date')) {
                $table->date('start_date')->nullable()->change();
            }
            if (Schema::hasColumn('posts', 'number_applicants')) {
                $table->integer('number_applicants')->nullable()->change();
            }
            if (Schema::hasColumn('posts', 'status')) {
                $table->integer('status')->nullable()->change();
            }
            if (Schema::hasColumn('posts', 'is_pinned')) {
                $table->boolean('is_pinned')->nullable()->change();
            }
            if (Schema::hasColumn('posts', 'slug')) {
                $table->string('slug')->nullable()->change();
            }
            if (Schema::hasColumn('posts', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->change();
            }
            if (Schema::hasColumn('posts', 'company_id')) {
                $table->unsignedBigInteger('company_id')->nullable()->change();
            }
        });
        Schema::table('companies', function (Blueprint $table) {
            if (Schema::hasColumn('companies', 'email')) {
                $table->string('email')->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
