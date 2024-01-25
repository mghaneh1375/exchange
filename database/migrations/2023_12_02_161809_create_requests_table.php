<?php

use App\Models\Currency;
use App\Models\Request;
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
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone', 20);
            $table->unsignedInteger('tracking_code');
            $table->unsignedInteger('amount');
            $table->enum('account_type', [Request::INDIVIDUAL_ACCOUNT, Request::COMPANY_ACCOUNT]);
            $table->unsignedInteger('currency_id');
            $table->index('currency_id');
            $table->foreign('currency_id')->on('currency')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('country_id');
            $table->index('country_id');
            $table->foreign('country_id')->on('country')->references('id')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('requests');
    }
};
