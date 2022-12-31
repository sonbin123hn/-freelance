<?php

use App\Enums\SexType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->string('phoneNumber');
            $table->string('password');
            $table->string('idFront')->nullable();
            $table->string('idBack')->nullable();
            $table->string('face')->nullable();
            $table->string('userName')->nullable();
            $table->string('cccd')->nullable();
            $table->enum('sex', [SexType::MALE, SexType::FEMALE, SexType::OTHER])->comment('0: MALE | 1: FEMALE | 2: OTHER')->nullable();
            $table->integer('birth')->nullable();
            $table->string('bankUserName')->nullable();
            $table->string('bankAccount')->nullable();
            $table->string('bank')->nullable();
            $table->float('salary')->nullable();
            $table->text('reason')->nullable();
            $table->string('address')->nullable();
            $table->string('job')->nullable();
            $table->string('relationship')->nullable();
            $table->string('phoneNumberRelationship')->nullable();
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
