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
        Schema::create('tickets', function (Blueprint $table) {
            $table->integer('id_ticket')->unsigned()->autoIncrement();
            $table->integer('id_ticket_origin')->unsigned();
            $table->integer('opened_by')->unsigned();
            $table->integer('closed_by')->unsigned();
            $table->integer('id_ticket_status')->unsigned();
            $table->integer('id_ticket_priority')->unsigned();
            $table->integer('id_ticket_type')->unsigned();
            $table->string('title', 300);
            $table->string('description', 3000);
            $table->dateTime('closed_at');
            $table->dateTime('created_at');
            $table->dateTime('last_update');

            $table->foreign('id_ticket_origin')->references('id_ticket_origin')->on('ticket_origin');
            $table->foreign('opened_by')->references('id_user')->on('users');
            $table->foreign('closed_by')->references('id_user')->on('users');
            $table->foreign('id_ticket_status')->references('id_ticket_status')->on('ticket_status');
            $table->foreign('id_ticket_priority')->references('id_ticket_priority')->on('ticket_priority');
            $table->foreign('id_ticket_type')->references('id_ticket_type')->on('ticket_type');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
