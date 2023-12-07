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
        Schema::create('up_link_capacities', function (Blueprint $table) {
            $table->id();
            $table->string('up_link_capacity_name', 100)->nullable(false);
            $table->boolean('up_link_capacity_active_status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('up_link_capacities');
    }
};
