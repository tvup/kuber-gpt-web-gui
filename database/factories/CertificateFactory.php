<?php

namespace Database\Factories;

use App\Models\Certificate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CertificateFactory extends Factory{
    protected $model = Certificate::class;

    public function definition(): array
    {
        return [
            'status' => $this->faker->word(),//
'expires_at' => Carbon::now(),
'revoked_at' => Carbon::now(),
'idcert' => $this->faker->word(),
'cert' => $this->faker->word(),
'link_conf' => $this->faker->word(),
'created_at' => Carbon::now(),
'updated_at' => Carbon::now(),
'stato' => $this->faker->word(),
'dt_scadenza' => Carbon::now(),
'dt_revoca' => Carbon::now(),
'user_id' => $this->faker->randomNumber(),
        ];
    }
}
