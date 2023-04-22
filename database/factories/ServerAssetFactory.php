<?php

namespace Database\Factories;

use App\Models\RunSet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ServerAssetFactory extends Factory
{
    protected $model = RunSet::class;

    public function definition(): array
    {
        return [
            'nick_name' => $this->faker->name(),
            'local_ip' => $this->faker->ipv4(),
            'public_ip' => $this->faker->ipv4(),
            'applications' => [['name' => $this->faker->word(), 'url' => $this->faker->url()]],
            'tags' => [$this->faker->word(), $this->faker->word(), $this->faker->word()],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
