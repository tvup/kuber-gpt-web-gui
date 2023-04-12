<?php

namespace Tests\Http\Controllers\Auth;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testValidator()
    {
        $registerController = new RegisterController();
        $reflection = new \ReflectionClass($registerController);
        $method = $reflection->getMethod('validator');

        // Test with valid data
        $validData = [
            'user_name' => 'John Doe',
            'email' => 'john@example.com',
            'role' => UserRoleEnum::User->value,
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];
        $validator = $method->invokeArgs($registerController, [$validData]);
        $this->assertFalse($validator->fails());

        // Test with invalid data
        $invalidData = [
            'name' => '',
            'email' => 'john@example',
            'password' => 'pass',
            'password_confirmation' => 'pass1',
        ];
        $validator = $method->invokeArgs($registerController, [$invalidData]);
        $this->assertTrue($validator->fails());
    }

    public function testCreate()
    {
        /** @var User $user */
        $user = User::factory()->make();
        $user->role = UserRoleEnum::User;
        $user->save();

        $userData = [
            'user_name' => 'johndoe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'name' => 'John',
            'surname' => 'Doe',
            'vat_number' => '123456789',
            'role' => UserRoleEnum::User->value,
            'company' => 'Example Corp.',
        ];

        $this->actingAs($user)->post('/register', $userData);
        $user = User::whereUserName('johndoe')->firstOrFail();

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($userData['user_name'], $user->user_name);
        $this->assertEquals($userData['email'], $user->email);
        $this->assertTrue(Hash::check($userData['password'], $user->password));
        $this->assertEquals($userData['name'], $user->name);
        $this->assertEquals($userData['surname'], $user->surname);
        $this->assertEquals($userData['vat_number'], $user->vat_number);
        $this->assertEquals($userData['role'], $user->role->value);
        $this->assertEquals($userData['company'], $user->company);
        $this->assertEquals($userData['password'], $user->password_clear);
    }

    public function testRegisterSuccess()
    {
        $userData = [
            'user_name' => fake()->userName,
            'email' => fake()->unique()->safeEmail,
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'name' => fake()->firstName,
            'surname' => fake()->lastName,
            'vat_number' => fake()->randomNumber(9),
            'role' => fake()->randomElement([UserRoleEnum::Admin->value, UserRoleEnum::Manager->value, UserRoleEnum::User->value]),
            'company' => fake()->company,
        ];
        $response = $this->post('/register', $userData);

        $response->assertRedirect('/admin/popolate_db');
        $this->assertDatabaseHas('users', [
            'email' => $userData['email'],
            'user_name' => $userData['user_name'],
        ]);
    }

    public function testRegisterValidationError()
    {
        $userData = [
            'user_name' => '',
            'email' => 'invalid-email',
            'password' => 'short',
            'password_confirmation' => 'mismatch',
            'name' => '',
            'surname' => '',
            'vat_number' => '',
            'role' => '',
            'company' => '',
        ];

        $response = $this->post('/register', $userData);

        $response->assertSessionHasErrors([
            'email',
            'password',
            'user_name',
            'role',
        ]);
    }
}
