<?php

namespace Database\Factories;

use App\Models\CredentialsSet;
use App\Models\RunSet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use InvalidArgumentException;

class RunSetFactory extends Factory
{
    protected $model = RunSet::class;

    public function definition(): array
    {
        $credentialSetId = null;
        try {
            $credentialSetId = CredentialsSet::all()->random();
        } catch (InvalidArgumentException $e) {

        }
        if(!$credentialSetId) {
            $credentialSetId = CredentialsSet::factory()->create();
        }
        return [
            'nick_name' => $this->faker->name(),
            'local_ip' => $this->faker->ipv4(),
            'public_ip' => $this->faker->ipv4(),
            'applications' => $this->faker->sentences(3, false),
            'tags' => $this->faker->sentences(3, false),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id' => User::all()->random()->id,
            'credentials_set_id' => $credentialSetId->id,
            'ai_self_name' => $this->faker->name()
        ];
    }
}
