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
        Schema::create('device_installations', function (Blueprint $table) {
            $table->id();
            $table->string('device_installation_registration_id', 20)->unique()->nullable(false);
            $table->char('device_installation_acceptance_status', 1)->nullable(false);
            $table->text('device_installation_message_from_dsi', 525)->nullable(true);
            $table->date('device_installation_booking_date')->nullable(true);
            $table->string('device_installation_file_name',200)->nullable(false);
            $table->string('device_installation_file_extension', 30)->nullable(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_installations');
    }
};
