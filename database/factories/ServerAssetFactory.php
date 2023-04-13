<?php

namespace Database\Factories;

use App\Models\ServerAsset;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ServerAssetFactory extends Factory
{
    protected $model = ServerAsset::class;

    public function definition(): array
    {
        return [
            'nick_name' => $this->faker->name(),
            'local_ip' => $this->faker->ipv4(),
            'public_ip' => $this->faker->ipv4(),
            'applications' => $this->faker->words(),
            'tags' => $this->faker->words(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
