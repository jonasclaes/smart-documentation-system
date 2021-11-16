<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterQRCodeFileID extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('qrcodes', function (Blueprint $table) {
            $table->dropForeign('qrcodes_fileid_foreign');
            $table->foreign('fileId')
                ->references('id')->on('files')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('qrcodes', function (Blueprint $table) {
            $table->dropForeign('qrcodes_fileid_foreign');
            $table->foreign('fileId')
                ->references('id')->on('files');
        });
    }
}
