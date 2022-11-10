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
            $table->string('ime');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('prezime');
            $table->string('korisnicko');
            $table->string('tipKorisnika');
            $table->double('ocena')->default(0);
            $table->integer('ocenilo')->default(0);
            $table->integer('sumaOcena')->default(0);
            $table->string('opis');
            $table->string('slika')->default('user.jpg');
            $table->string('radovi')->default('noimage.png');
            $table->rememberToken();
            //$table->timestamps();
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
