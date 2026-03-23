<?php

namespace App\Http\Services;

use App\Exceptions\FfmpegNotFoundException;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\ExecutableFinder;
use Symfony\Component\Process\Process;

class IntroductionVideoService
{
  private const DIRECTORY = 'introduction-video';

  private const VIDEO_FILENAME = 'introduction-video.mp4';

  private const POSTER_FILENAME = 'video-cover.jpg';

  public function replaceVideo(array $videoInput): void
  {
    $disk = Storage::disk('public');
    $tempPath = $videoInput[0];

    $disk->delete(self::DIRECTORY.'/'.self::VIDEO_FILENAME);
    $disk->delete(self::DIRECTORY.'/'.self::POSTER_FILENAME);

    $disk->move($tempPath, self::DIRECTORY.'/'.self::VIDEO_FILENAME);

    $this->generatePoster(
      $disk->path(self::DIRECTORY.'/'.self::VIDEO_FILENAME),
      $disk->path(self::DIRECTORY.'/'.self::POSTER_FILENAME),
    );
  }

  private function generatePoster(string $videoPath, string $posterPath): void
  {
    $ffmpeg = (new ExecutableFinder)->find('ffmpeg');

    if ($ffmpeg === null) {
      throw new FfmpegNotFoundException('FFmpeg nav instalēts. Priekšskatījuma bilde netika ģenerēta.');
    }

    $process = new Process([
      $ffmpeg,
      '-i', $videoPath,
      '-vframes', '1',
      '-q:v', '2',
      '-y',
      $posterPath,
    ]);

    $process->run();

    if (! $process->isSuccessful()) {
      throw new \RuntimeException('FFmpeg poster generation failed: '.$process->getErrorOutput());
    }
  }
}
