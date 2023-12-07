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
        Schema::create('device_maintenances', function (Blueprint $table) {
            $table->id();
            $table->string('device_maintenance_registration_id', 20)->unique()->nullable(false);
            $table->text('device_maintenance_note', 525)->nullable(true);
            $table->text('device_maintenance_message_from_dsi', 525)->nullable(true);
            $table->date('device_maintenance_booking_date')->nullable(false);
            $table->char('device_maintenance_acceptance_status', 1)->nullable(false);
            $table->string('maintainable_part', 30)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_maintenances');
    }
};
