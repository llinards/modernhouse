<?php

namespace Tests\Feature;

use Tests\TestCase;

class GeneralTest extends TestCase
{
  /**
   * A basic test example.
   *
   * @return void
   */
  public function test_page_can_be_opened()
  {
    $response = $this->get('/');
    $response->assertRedirect('/lv');
  }
}
