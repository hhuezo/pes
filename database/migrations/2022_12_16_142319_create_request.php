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
        /*Schema::create('request', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employer_id')->unsigned();
            $table->date('start_date')->nullable(true);
            $table->date('end_date')->nullable(true);
            $table->boolean('need_h2b_workers')->nullable(true);
            $table->string('explain_multiple_employment')->nullable(true);
            $table->boolean('paid')->nullable(true);
            $table->boolean('is_uniform_required')->nullable(true);
            $table->string('uniform_pieces_required')->nullable(true);
            $table->string('job_notes')->nullable(true);
            $table->bigInteger('user_id')->unsigned();
            $table->timestamp('created_at')->nullable(true);


            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('employer_id')->references('id')->on('employer');
        });*/


     /* Schema::create('request_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_id')->unsigned();
            $table->boolean('listed_above')->nullable(true);
            $table->integer('job_title_id');
            $table->integer('number_workers');
            $table->boolean('it_has_cba')->nullable(true);
            $table->string('how_paid')->nullable(true);
            $table->string('pay_rate')->nullable(true);
            $table->boolean('use_tip_credit')->nullable(true);
            $table->boolean('is_there_benefits')->nullable(true);
            $table->string('explain_benefits')->nullable(true);
            $table->boolean('are_there_any_requeriments')->nullable(true);
            $table->string('requeriments')->nullable(true);
            $table->string('any_additional_wage_notes')->nullable(true);
            $table->boolean('is_overtime_available')->nullable(true);
            $table->integer('ant_workday_sun_hour');
            $table->integer('ant_workday_mon_hour');
            $table->integer('ant_workday_tue_hour');
            $table->integer('ant_workday_wed_hour');
            $table->integer('ant_workday_thu_hour');
            $table->integer('ant_workday_fri_hour');
            $table->integer('ant_workday_sat_hour');
            $table->integer('ant_workday_total_hours');
            $table->integer('primary_shift_time');
            $table->boolean('are_there_additional_shift_times')->nullable(true);
            $table->bigInteger('user_id')->unsigned();
            $table->timestamp('created_at')->nullable(true);

            $table->foreign('user_id')->references('id')->on('users');
           $table->foreign('request_id')->references('id')->on('request');
            //$table->foreign('job_title_id')->references('id')->on('catalog_job_title');
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('request_detail');
        //Schema::dropIfExists('request');
    }
};
