<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('role_id')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });

//        \App\Http\Controllers\Auth\RegisterController::create(array(
//            'name'=>'admin',
//            'email'=>'admin@admin.com',
//            'passowrd'=>'password'
//        ))

        \Illuminate\Support\Facades\DB::table('users')->insert([ //TODO:: Fill this with real data
            'name'=>'admin',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('password'),
            'role_id'=>3
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
}
