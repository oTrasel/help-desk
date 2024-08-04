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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id_user')->unsigned()->autoIncrement();
            $table->integer('id_role');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('able_login')->default(1);
            $table->timestamps();

            $table->foreign('id_role')->references('id_role')->on('roles');
        });


        //Modify before insert
        DB::table('users')->insert([
            [ 'id_role' => '1', 'name' => 'Admin', 'email' => 'admin@admin.com', 'password' => bcrypt('admin'), 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
