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
        Schema::create('hard_disk_servers', function (Blueprint $table) {
            $table->id();
            $table->string('hard_disk_amount_of_piece', 30)->nullable(false);
            $table->string('hard_disk_capacity_of_piece', 30)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hard_disk_servers');
    }
};
