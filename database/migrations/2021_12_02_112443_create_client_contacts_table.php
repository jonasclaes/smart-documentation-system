<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_contacts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('clientId')->constrained('clients');
            $table->string('firstName', 255);
            $table->string('lastName', 255);
            $table->string('role', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('phoneNumber', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_contacts');
    }
}
