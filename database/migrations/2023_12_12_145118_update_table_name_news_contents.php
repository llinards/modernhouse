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
    Schema::rename('news_contents', 'news');
    Schema::table('news_images', function (Blueprint $table) {
      $table->renameColumn('news_content_id', 'news_id');
    });
    Schema::table('news_attachments', function (Blueprint $table) {
      $table->renameColumn('news_content_id', 'news_id');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::rename('news', 'news_contents');
    Schema::table('news_images', function (Blueprint $table) {
      $table->renameColumn('news_id', 'news_content_id');
    });
    Schema::table('news_attachments', function (Blueprint $table) {
      $table->renameColumn('news_id', 'news_content_id');
    });
  }
};
