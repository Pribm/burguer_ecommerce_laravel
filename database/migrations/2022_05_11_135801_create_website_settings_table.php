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
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name', 128);
            $table->string('email_address', 256);
            $table->string('slogan', 256)->nullable();
            $table->string('footer_message', 256)->nullable();
            $table->string('facebook_address')->nullable();
            $table->string('instagram_address')->nullable();
            $table->string('twitter_address')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('horizontal_logo')->nullable();
            $table->string('vertical_logo')->nullable();
            $table->string('favicon')->nullable();
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
        Schema::dropIfExists('website_settings');
    }
};
