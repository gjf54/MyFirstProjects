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
        Schema::create('user', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->id('id');
            $table->string('name', 32);
            $table->string('login', 32)->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar')->default('default.gif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
