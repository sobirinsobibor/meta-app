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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('device_registration_id', 20)->unique()->nullable(false);
            $table->string('device_name', 100)->nullable(false);
            $table->integer('device_purchase_year')->nullable(false);
            $table->string('device_description', 255)->nullable(true);
            $table->boolean('device_active_status')->default(true)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
