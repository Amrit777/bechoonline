<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewColsUsersRegistrationScenarioWhatsappStorename extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('whatsapp_number')->nullable();
            $table->string('store_name')->nullable();
        });
        Schema::table('domains', function (Blueprint $table) {
            $table->string('domain_purchased_from')->nullable();
            $table->string('domain_username')->nullable();
            $table->string('domain_password')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
