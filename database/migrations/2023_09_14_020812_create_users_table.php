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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->char('user_nip', 18)->unique()->nullable(false);
            $table->string('user_full_name', 100)->nullable(false);
            $table->string('user_email', 100)->unique()->nullable(false);
            $table->string('user_phone', 15)->unique()->nullable(false);
            $table->string('password', 255)->nullable(false);
            $table->boolean('user_active_status')->default(true)->nullable(false);
            
            $table->timestamps();
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
