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


        /*Schema::create('catalog_city_zip', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('czc_state_fips');
            $table->string('czc_state');
            $table->string('czc_state_abbr',5);
            $table->string('czc_zipcode',5);
            $table->string('czc_county');
            $table->string('czc_city');
        });*/

        Schema::create('employer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('legal_business_name')->nullable(false);
            $table->boolean('applicable_trade_name')->default(1);
            $table->string('trade_name')->nullable(false);
            $table->char('federal_id_number', 20);
            $table->integer('year_business_established');
            $table->integer('number_employees_full_time');
            $table->string('primary_business_phone',20);
            $table->string('primary_business_fax',20);
            $table->string('quantity_year_has_participate_h2b',3);
            $table->integer('primary_business_type_id');
            $table->integer('naics_id');
            $table->string('naics_code');
            $table->decimal('year_end_gross_company_income', 12, 2);
            $table->decimal('year_end_net_company_income', 12, 2);

            $table->integer('principal_state_id');
            $table->integer('principal_county_id');
            $table->integer('principal_city_id');
            $table->string('principal_street_address');
            $table->char('principal_zip_code',5);
            $table->boolean('mailing_address_same_above')->default(0);
            $table->integer('mailing_state_id');
            $table->integer('mailing_county_id');
            $table->integer('mailing_city_id');
            $table->string('mailing_street_address');
            $table->char('mailing_zip_code',5);

            $table->string('primary_contact_name');
            $table->string('primary_contact_last_name');
            $table->string('primary_contact_job_title');
            $table->string('primary_contact_email');
            $table->string('primary_contact_phone',20);
            $table->string('primary_contact_cellphone',20);
            $table->char('add_contact_person',1);

            $table->string('additional_contact');
            $table->string('additional_contact_job_title');
            $table->string('additional_contact_email');
            $table->string('additional_contact_phone',20);
            $table->string('additional_contact_cellphone',20);

            $table->char('signed_all_documents',1);
            $table->string('signatory_name');
            $table->string('signatory_last_name');
            $table->string('signatory_job_title');
            $table->string('signatory_email');
            $table->string('signatory_phone',20);

            $table->integer('normal_business_days_id');
            $table->string('normal_business_days_other');
            $table->char('is_transportation_provided',0);
            $table->string('how_far_transportation_from_worksite');
            $table->string('local_transportation_website');
            $table->string('place_employment_notes');

            $table->char('is_there_additional_worksite',null);
            $table->char('is_main_worksite_location',null);

            $table->string('main_worksite_location');
            $table->integer('main_worksite_state_id');
            $table->integer('main_worksite_county_id');
            $table->integer('main_worksite_city_id');
            $table->char('main_worksite_zip_code',5);
            $table->char('validated',0);



            $table->foreign('primary_business_type_id')->references('id')->on('catalogue_primary_business_type');
            $table->foreign('naics_id')->references('id')->on('catalogue_naics_code');


            $table->foreign('principal_state_id')->references('id')->on('catalog_city_zip');
            $table->foreign('principal_county_id')->references('id')->on('catalog_city_zip');
            $table->foreign('principal_city_id')->references('id')->on('catalog_city_zip');

            $table->foreign('mailing_state_id')->references('id')->on('catalog_city_zip');
            $table->foreign('mailing_county_id')->references('id')->on('catalog_city_zip');
            $table->foreign('mailing_city_id')->references('id')->on('catalog_city_zip');

            $table->foreign('normal_business_days_id')->references('id')->on('catalogue_normal_business_days');




            $table->foreign('main_worksite_state_id')->references('id')->on('catalog_city_zip');
            $table->foreign('main_worksite_county_id')->references('id')->on('catalog_city_zip');
            $table->foreign('main_worksite_city_id')->references('id')->on('catalog_city_zip');
        });


        Schema::create('users_has_employers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employer_id')->unsigned();
            $table->bigInteger('users_id')->unsigned();

            $table->foreign('employer_id')->references('id')->on('employer');
            $table->foreign('users_id')->references('id')->on('users');
        });


        Schema::create('casemanager_has_recruiter', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('casemanager_id')->unsigned();
            $table->bigInteger('recruiter_id')->unsigned();

            $table->foreign('casemanager_id')->references('id')->on('users');
            $table->foreign('recruiter_id')->references('id')->on('users');
        });


        Schema::create('casemanager_has_employer', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('casemanager_id')->unsigned();
            $table->integer('employer_id')->unsigned();

            $table->foreign('casemanager_id')->references('id')->on('users');
            $table->foreign('employer_id')->references('id')->on('employer');
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('casemanager_has_employer');
        Schema::dropIfExists('casemanager_has_recruiter');
        Schema::dropIfExists('users_has_employers');
        Schema::dropIfExists('employer');
        Schema::dropIfExists('catalog_city_zip');
    }
};
