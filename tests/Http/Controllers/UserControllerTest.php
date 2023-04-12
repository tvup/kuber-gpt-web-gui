<?php

namespace Tests\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @throws \ReflectionException
     */
    public function testValidator()
    {
        $userController = new UserController();
        $reflection = new \ReflectionClass($userController);
        $method = $reflection->getMethod('validator');

        // Test with valid data
        $validData = [
            'user_name' => fake()->firstName,
            'email' => fake()->email,
            'role' => fake()->randomElement([UserRoleEnum::User->value, UserRoleEnum::Manager->value, UserRoleEnum::Admin->value]),
        ];
        $validator = $method->invokeArgs($userController, [$validData]);
        $this->assertFalse($validator->fails());

        // Test with invalid data
        $invalidData = [
            'user_name' => '',
            'email' => 'aa',
            'role' => '',
        ];
        $validator = $method->invokeArgs($userController, [$invalidData]);
        $this->assertTrue($validator->fails());
    }

    public function testIndex()
    {
        User::truncate();
        // Seed the database with some test users
        $users = User::factory()->count(3)->make();

        $user = User::factory()->make();
        $user->role = UserRoleEnum::Admin;

        $users->add($user);

        foreach ($users as $user) {
            $user->save();
        }

        $response = $this->actingAs($user)->get('admin/showallusers');

        $response->assertViewIs('admin.showallusers');
        $response->assertViewHas('users');
        $users = $response->viewData('users');
        $this->assertCount(4, $users);
    }

    public function testShow()
    {
        // Seed the database with a test user
        /** @var User $user */
        $user = User::factory()->make();
        $user->role = UserRoleEnum::Admin;
        $user->save();

        $response = $this->actingAs($user)->get('admin/show/'.$user->id);

        $response->assertViewIs('admin.showuser');
        $response->assertViewHas('user');
        $viewUser = $response->viewData('user');
        $this->assertEquals($user->id, $viewUser->id);
    }

    public function testEdit()
    {
        // Seed the database with a test user
        /** @var User $user */
        $user = User::factory()->make();
        $user->role = UserRoleEnum::Admin;
        $user->save();

        $response = $this->actingAs($user)->get('/admin/edituser/'.$user->id);

        $response->assertViewIs('admin.edituser');
        $response->assertViewHas('user');
        $viewUser = $response->viewData('user');
        $this->assertEquals($user->id, $viewUser->id);
    }

    public function testUpdate()
    {
        // Seed the database with a test user
        /** @var User $user */
        $user = User::factory()->make();
        $user->role = UserRoleEnum::Admin;
        $user->save();

        $updatedData = [
            'name' => fake()->firstName,
            'surname' => fake()->lastName,
            'vat_number' => fake()->bothify('??#####'),
            'company' => fake()->company,
        ];

        $response = $this->actingAs($user)->post('admin/updateuser/'.$user->id, $updatedData);

        $response->assertSessionHas('msg-success', 'Profile updated!');

        $updatedUser = User::find($user->id);
        $this->assertEquals($updatedData['name'], $updatedUser->name);
        $this->assertEquals($updatedData['surname'], $updatedUser->surname);
        $this->assertEquals($updatedData['vat_number'], $updatedUser->vat_number);
        $this->assertEquals($updatedData['company'], $updatedUser->company);
    }

    public function testDel()
    {
        // Seed the database with a test user
        /** @var User $user */
        $user = User::factory()->create();

        $userController = new UserController();
        $userController->del($user->id);

        $deletedUser = User::find($user->id);
        $this->assertNull($deletedUser);
    }
}
