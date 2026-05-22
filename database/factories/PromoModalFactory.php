<?php

namespace Database\Factories;

use App\Models\PromoModal;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PromoModal>
 */
class PromoModalFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'is_enabled' => true,
      'starts_at' => null,
      'ends_at' => null,
      'image_filename' => 'promo.jpg',
      'title' => $this->faker->sentence(3),
      'description' => $this->faker->paragraph(),
      'cta_label' => $this->faker->words(2, true),
      'cta_url' => 'https://'.$this->faker->domainName().'/'.$this->faker->slug(),
    ];
  }

  public function disabled(): self
  {
    return $this->state(['is_enabled' => false]);
  }
}
