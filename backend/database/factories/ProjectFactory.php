<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory {
  protected $model = Project::class;

  public function definition() {
    return [
      'name' => $this->faker->words(2, true),
      'link' => $this->faker->url,
      'description' => $this->faker->sentence(3, true),
      'image' => $this->faker->imageUrl(),
    ];
  }
}
