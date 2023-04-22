<?php

namespace Database\Factories;

use App\Models\CredentialsSet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CredentialsSetFactory extends Factory
{
    protected $model = CredentialsSet::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
