<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum("jabatan", ['kord_dpo', 'dpo', 'kord_tim_ahli', 'tim_ahli', 'ketum', 'sekum', 'bendum', 'wk1', 'wk2', 'kord_keorganisasian', 'staff_keorganisasian', 'kord_P&R', 'staff_P&R', 'kord_tools', 'staff_tools', 'kord_keilmuan', 'kord_program', 'staff_program', 'kord_jaringan', 'staff_jaringan', 'kord_hardware', 'staff_hardware', 'kord_multimedia', 'staff_multimedia', 'all_crew']);
            $table->string("phone");
            $table->string("noreg");
            $table->string("status_surat")->nullable();
            $table->string("foto")->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
