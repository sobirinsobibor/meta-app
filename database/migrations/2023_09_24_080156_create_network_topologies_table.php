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
        Schema::create('network_topologies', function (Blueprint $table) {
            $table->id();
            $table->string('network_topology_registration_id', 20)->unique()->nullable(false);
            $table->string('network_topology_description', 255)->nullable(false);
            $table->string('network_topology_file_name')->nullable(false);
            $table->string('network_topology_file_extension', 30)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('network_topologies');
    }
};
