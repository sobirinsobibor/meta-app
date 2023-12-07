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
        //users
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_role');
            $table->unsignedBigInteger('id_team_unit');

            $table->foreign('id_role')->references('id')->on('roles');
            $table->foreign('id_team_unit')->references('id')->on('team_units');
        });

        //devices
        Schema::table('devices', function(Blueprint $table) {
            $table->unsignedBigInteger('id_device_type');
            $table->unsignedBigInteger('id_device_brand');
            $table->unsignedBigInteger('id_team_unit');
            $table->unsignedBigInteger('id_menu');

            $table->foreign('id_device_type')->references('id')->on('device_types');
            $table->foreign('id_device_brand')->references('id')->on('device_brands');
            $table->foreign('id_team_unit')->references('id')->on('team_units');
            $table->foreign('id_menu')->references('id')->on('menus');
        });

        //network_topologies
        Schema::table('network_topologies', function(Blueprint $table) {
            $table->char('user_nip', 18);
            $table->unsignedBigInteger('id_team_unit');
            $table->unsignedBigInteger('id_user');

            $table->foreign('user_nip')->references('user_nip')->on('users');
            $table->foreign('id_team_unit')->references('id')->on('team_units');
            $table->foreign('id_user')->references('id')->on('users');
        });

        //wifi_mappings
        Schema::table('wifi_mappings', function(Blueprint $table) {
            $table->char('user_nip', 18);
            $table->unsignedBigInteger('id_team_unit');
            $table->unsignedBigInteger('id_user');

            $table->foreign('user_nip')->references('user_nip')->on('users');
            $table->foreign('id_team_unit')->references('id')->on('team_units');
            $table->foreign('id_user')->references('id')->on('users');
        });

        //device_instalations
        Schema::table('device_installations', function(Blueprint $table) {
            $table->char('user_nip', 18);
            $table->unsignedBigInteger('id_team_unit');
            $table->unsignedBigInteger('id_user');
            $table->string('device_registration_id', 20);

            $table->foreign('user_nip')->references('user_nip')->on('users');
            $table->foreign('id_team_unit')->references('id')->on('team_units');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('device_registration_id')->references('device_registration_id')->on('devices');
        });

        //device_maintenances
        Schema::table('device_maintenances', function(Blueprint $table) {
            $table->char('user_nip', 18);
            $table->unsignedBigInteger('id_team_unit');
            $table->unsignedBigInteger('id_user');
            $table->string('device_registration_id', 20);
            $table->unsignedBigInteger('id_maintenance_service');

            $table->foreign('user_nip')->references('user_nip')->on('users');
            $table->foreign('id_team_unit')->references('id')->on('team_units');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('device_registration_id')->references('device_registration_id')->on('devices');
            $table->foreign('id_maintenance_service')->references('id')->on('maintenance_services');
        });

        //device_dismantles
        Schema::table('device_dismantles', function(Blueprint $table) {
            $table->char('user_nip', 18);
            $table->unsignedBigInteger('id_team_unit');
            $table->unsignedBigInteger('id_user');
            $table->string('device_registration_id', 20);

            $table->foreign('user_nip')->references('user_nip')->on('users');
            $table->foreign('id_team_unit')->references('id')->on('team_units');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('device_registration_id')->references('device_registration_id')->on('devices');
        });

        Schema::table('i_p_servers', function(Blueprint $table) {
            $table->string('device_registration_id', 20);
            $table->foreign('device_registration_id')->references('device_registration_id')->on('devices');
        });

        Schema::table('detail_identity_servers', function(Blueprint $table) {
            $table->unsignedBigInteger('id_server_type');
            $table->unsignedBigInteger('id_device_category');
            $table->string('device_registration_id', 20);

            $table->foreign('device_registration_id')->references('device_registration_id')->on('devices');
            $table->foreign('id_server_type')->references('id')->on('server_types');
            $table->foreign('id_device_category')->references('id')->on('device_categories');
        });

        Schema::table('hard_disk_servers', function(Blueprint $table){
            $table->string('device_registration_id', 20);

            $table->foreign('device_registration_id')->references('device_registration_id')->on('devices');
        });

        Schema::table('memory_servers', function(Blueprint $table){
            $table->string('device_registration_id', 20);

            $table->foreign('device_registration_id')->references('device_registration_id')->on('devices');
        });

        Schema::table('processor_servers', function(Blueprint $table){
            $table->string('device_registration_id', 20);

            $table->foreign('device_registration_id')->references('device_registration_id')->on('devices');
        });

        Schema::table('up_links', function(Blueprint $table){
            $table->unsignedBigInteger('id_up_link_type');
            $table->unsignedBigInteger('id_up_link_capacity');
            $table->unsignedBigInteger('id_up_link_transmission_speed');

            $table->foreign('id_up_link_type')->references('id')->on('up_link_types');
            $table->foreign('id_up_link_capacity')->references('id')->on('up_link_capacities');
            $table->foreign('id_up_link_transmission_speed')->references('id')->on('up_link_transmission_speeds');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_role']); 
            $table->dropColumn('id_role'); 

            $table->dropForeign(['id_team_unit']); 
            $table->dropColumn('id_team_unit'); 

        });

        Schema::table('devices', function (Blueprint $table){
            $table->dropForeign(['id_device_type']); 
            $table->dropColumn('id_device_type'); 
           
            $table->dropForeign(['id_device_brand']); 
            $table->dropColumn('id_device_brand'); 

            $table->dropForeign(['id_team_unit']); 
            $table->dropColumn('id_team_unit'); 

            $table->dropForeign(['id_menu']); 
            $table->dropColumn('id_menu'); 
        });

        Schema::table('network_topologies', function(Blueprint $table) {
            $table->dropForeign(['user_nip']); 
            $table->dropColumn('user_nip'); 

            $table->dropForeign(['id_team_unit']); 
            $table->dropColumn('id_team_unit'); 
            
            $table->dropForeign(['id_user']); 
            $table->dropColumn('id_user'); 

        });

        Schema::table('wifi_mappings', function(Blueprint $table) {
            $table->dropForeign(['user_nip']); 
            $table->dropColumn('user_nip'); 

            $table->dropForeign(['id_team_unit']);
            $table->dropColumn('id_team_unit'); 
            
            $table->dropForeign(['id_user']); 
            $table->dropColumn('id_user'); 

        });

        Schema::table('device_installations', function(Blueprint $table) {
            $table->dropForeign(['user_nip']); 
            $table->dropColumn('user_nip'); 

            $table->dropForeign(['id_team_unit']); 
            $table->dropColumn('id_team_unit'); 
            
            $table->dropForeign(['id_user']); 
            $table->dropColumn('id_user'); 
            
            $table->dropForeign(['device_registration_id']); 
            $table->dropColumn('device_registration_id'); 

        });

        // device_maintenances
        Schema::table('device_maintenances', function(Blueprint $table) {
            $table->dropForeign(['user_nip']); 
            $table->dropColumn('user_nip'); 

            $table->dropForeign(['id_team_unit']); 
            $table->dropColumn('id_team_unit'); 
            
            $table->dropForeign(['id_user']); 
            $table->dropColumn('id_user'); 

            $table->dropForeign(['device_registration_id']); 
            $table->dropColumn('device_registration_id'); 

            $table->dropForeign(['id_maintenance_service']); 
            $table->dropColumn('id_maintenance_service'); 

        });

        // device_dismantles
        Schema::table('device_dismantles', function(Blueprint $table) {
            $table->dropForeign(['user_nip']); 
            $table->dropColumn('user_nip'); 

            $table->dropForeign(['id_team_unit']); 
            $table->dropColumn('id_team_unit'); 
            
            $table->dropForeign(['id_user']); 
            $table->dropColumn('id_user'); 

            $table->dropForeign(['device_registration_id']); 
            $table->dropColumn('device_registration_id'); 

        });

        Schema::table('i_p_servers', function(Blueprint $table) {
            
            $table->dropForeign(['device_registration_id']); 
            $table->dropColumn('device_registration_id'); 

        });

        Schema::table('detail_identity_servers', function(Blueprint $table) {

            $table->dropForeign(['id_server_type']); 
            $table->dropColumn('id_server_type');
            
            $table->dropForeign(['id_device_category']); 
            $table->dropColumn('id_device_category');

            $table->dropForeign(['device_registration_id']); 
            $table->dropColumn('device_registration_id');

        });

        Schema::table('hard_disk_servers', function(Blueprint $table) {
            $table->dropForeign(['device_registration_id']); 
            $table->dropColumn('device_registration_id');
        });

        Schema::table('memory_servers', function(Blueprint $table) {
            $table->dropForeign(['device_registration_id']); 
            $table->dropColumn('device_registration_id');
        });

        Schema::table('processor_servers', function(Blueprint $table) {
            $table->dropForeign(['device_registration_id']); 
            $table->dropColumn('device_registration_id');
        });

        Schema::table('up_links', function(Blueprint $table){
            $table->dropForeign(['id_up_link_capacity']); 
            $table->dropColumn('id_up_link_capacity');

            $table->dropForeign(['id_up_link_capacity']); 
            $table->dropColumn('id_up_link_capacity');

            $table->dropForeign(['id_up_link_capacity']); 
            $table->dropColumn('id_up_link_capacity');
        });

    }
};
