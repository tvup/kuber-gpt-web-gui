<?php

namespace Database\Factories;

use App\Enums\CredentialTypeEnum;
use App\Models\Credential;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CertificateFactory extends Factory
{
    protected $model = Credential::class;

    public function definition(): array
    {
        return [
            'status' => fake()->randomElement([CredentialTypeEnum::V, CredentialTypeEnum::E, CredentialTypeEnum::R]),
            'expires_at' => Carbon::today()->subDays(rand(0, 179))->addSeconds(rand(0, 86400)),
            'revoked_at' => fake()->randomElement([Carbon::today()->subDays(rand(0, 179))->addSeconds(rand(0, 86400)), null]),
            'idcert' => $this->faker->md5,
            'cert' => '/CN='.$this->faker->firstName(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id' => User::factory()->create()->id,
        ];
    }
}
