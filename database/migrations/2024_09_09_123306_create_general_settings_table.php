<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('favicon')->nullable();
            $table->string('logo')->nullable();
            $table->string('application_name')->nullable();
            $table->string('timezone')->nullable();
            $table->string('currency')->nullable();
            $table->integer('default_language')->length(5);
            $table->string('email_from');
            $table->string('smtp_host')->nullable();
            $table->integer('smtp_port')->length(11)->nullable();
            $table->string('smtp_user')->nullable();
            $table->string('smtp_pass')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('google_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('recaptcha_secret_key')->nullable();
            $table->string('recaptcha_site_key')->nullable();
            $table->string('recaptcha_lang')->nullable();
            $table->string('website_address')->nullable();
            $table->string('website_phone')->nullable();
            $table->string('website_email')->nullable();
            $table->string('vat')->nullable();
            $table->string('prefix')->nullable();
            $table->string('miles')->nullable(); 
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
        Schema::dropIfExists('general_settings');
    }
}
