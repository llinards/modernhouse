<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsAttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('news_attachments')->insert([
      [
        'attachment_location' => 'atbrivotaju-ielas-projekts/ATBRIVOTAJU_IELAS_PROJEKTS.pdf',
        'news_content_id' => 1,
        'created_at' => Carbon::now(),
      ],
    ]);
  }
}
