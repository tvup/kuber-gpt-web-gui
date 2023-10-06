<?php

namespace Database\Factories;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        $allowed_a_is = $this->faker->numberBetween(0, 3);
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt($this->faker->password()),
            'vat_number' => $this->faker->word(),
            'name' => $this->faker->name(),
            'remember_token' => Str::random(10),
            'role' => UserRoleEnum::User,
            'password_clear' => bcrypt($this->faker->password()),
            'company' => $this->faker->company(),
            'locale' => 'da_dk',
            'allowed_a_is' => $allowed_a_is,
            'a_is_running' => $this->faker->numberBetween(0, $allowed_a_is),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
