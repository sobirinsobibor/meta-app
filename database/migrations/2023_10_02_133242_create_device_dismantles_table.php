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
        Schema::create('device_dismantles', function (Blueprint $table) {
            $table->id();
            $table->string('device_dismantle_registration_id', 20)->unique()->nullable(false);
            $table->string('device_dismantle_file_name',200)->nullable(false);
            $table->string('device_dismantle_file_extension', 30)->nullable(false);
            $table->text('device_dismantle_reason', 525)->nullable(false);
            $table->date('device_dismantle_booking_date')->nullable(false);
            $table->text('device_dismantle_message_from_dsi', 500)->nullable(true);
            $table->char('device_dismantle_acceptance_status', 1)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_dismantles');
    }
};
