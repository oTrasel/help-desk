<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_commentary', function (Blueprint $table) {
            $table->integer('id_ticket_commentary')->unsigned()->autoIncrement();
            $table->integer('id_ticket')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->boolean('private')->default(0);
            $table->string('ticket_commentary', 10000);
            $table->dateTime('created_at');
            $table->dateTime('exluded_at');

            $table->foreign('id_ticket')->references('id_ticket')->on('tickets');
            $table->foreign('id_user')->references('id_user')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_commentary');
    }
};
