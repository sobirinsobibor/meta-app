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
        Schema::create('processor_servers', function (Blueprint $table) {
            $table->id();
            $table->string('processor_amount_of_piece', 30)->nullable(false);
            $table->string('processor_amount_of_core', 30)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processor_servers');
    }
};