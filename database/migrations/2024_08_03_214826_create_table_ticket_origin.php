<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('ticket_origin', function (Blueprint $table) {
            $table->integer('id_ticket_origin')->unsigned()->autoIncrement();
            $table->string('ticket_origin', 300);
            $table->timestamps();
        });

        DB::table('ticket_origin')->insert([
            [ 'ticket_origin' => 'Open manually', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ],
            [ 'ticket_origin' => 'Open by email', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_origin');
    }
};
