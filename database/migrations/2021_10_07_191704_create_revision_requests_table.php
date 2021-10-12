<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisionRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revision_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('technicianFirstName', 255)->nullable();
            $table->string('technicianLastName', 255)->nullable();
            $table->string('technicianEmail', 255)->nullable();
            $table->boolean('submitted');

            $table->foreignId('fileId')->constrained('files');
            $table->foreignId('categoryId')->constrained('revision_request_categories');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('revision_requests');
    }
}
