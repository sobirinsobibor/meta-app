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
        Schema::create('wifi_mappings', function (Blueprint $table) {
            $table->id();
            $table->string('wifi_mapping_registration_id', 20)->unique()->nullable(false);
            $table->string('wifi_mapping_description', 255)->nullable(false);
            $table->string('wifi_mapping_file_name')->nullable(false);
            $table->string('wifi_mapping_file_extension', 30)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wifi_mappings');
    }
};
