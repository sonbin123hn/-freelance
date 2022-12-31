<?php

use App\Enums\LoanTime;
use App\Enums\StatusLoanContracts;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('loanValue');
            $table->enum('loanTime', [6,12,24,36,48,60]);
            $table->string('signature');
            $table->string('prive');
            $table->bigInteger('userId');
            $table->enum('status', [StatusLoanContracts::PENDING,StatusLoanContracts::CANCEL,StatusLoanContracts::SUCCESS])->default(StatusLoanContracts::PENDING)->nullable();
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
        Schema::dropIfExists('loan_contracts');
    }
}
