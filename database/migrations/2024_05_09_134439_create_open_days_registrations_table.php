<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('open_days_registrations', function (Blueprint $table) {
      $table->id();
      $table->string('firstName');
      $table->string('lastName');
      $table->string('date');
      $table->time('time');
      $table->string('phoneNumber');
      $table->string('email');
      $table->text('questions')->nullable();
      $table->boolean('consentToProcessPersonalData');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('open_days_registrations');
  }
};
