<?php

namespace Database\Factories;

use App\Enums\UserRoleEnum;
use App\Enums\VPNTypeEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'user_name' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt($this->faker->password()),
            'vat_number' => $this->faker->word(),
            'name' => $this->faker->name(),
            'surname' => $this->faker->word(),
            'remember_token' => Str::random(10),
            'role' => UserRoleEnum::User,
            'password_clear' => bcrypt($this->faker->password()),
            'company' => $this->faker->company(),
            'vpn_type' => VPNTypeEnum::FULL,
            'locale' => 'da_dk',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
