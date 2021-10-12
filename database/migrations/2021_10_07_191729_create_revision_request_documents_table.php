<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisionRequestDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revision_request_documents', function (Blueprint $table) {
            $table->id();
            $table->string('fileName', 255);
            $table->string('path', 255);
            $table->integer('size')->default(0);

            $table->foreignId('revisionRequestId')->constrained('revision_requests');

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
        Schema::dropIfExists('revision_request_documents');
    }
}
