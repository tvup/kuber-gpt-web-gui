<?php

namespace Tests\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\UserController;
use App\Models\User;
use Carbon\Carbon;
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
        // Seed the database with some test users
        $users = User::factory()->count(3)->make();

        $user = User::factory()->make();
        $user->role = UserRoleEnum::Admin;
        $user->approved_at = Carbon::now('Europe/Copenhagen');

        $users->add($user);

        foreach ($users as $user) {
            $user->save();
        }

        $response = $this->actingAs($user)->get('admin/users');

        $response->assertViewIs('admin.users.index');
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
        $user->approved_at = Carbon::now('Europe/Copenhagen');
        $user->save();

        $response = $this->actingAs($user)->get('admin/users/'.$user->id);

        $response->assertViewIs('admin.users.show');
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
        $user->approved_at = Carbon::now('Europe/Copenhagen');
        $user->save();

        $response = $this->actingAs($user)->get('/admin/users/'.$user->id.'/edit');

        $response->assertViewIs('admin.users.edit');
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
        $user->approved_at = Carbon::now('Europe/Copenhagen');
        $user->save();

        $updatedData = [
            'name' => fake()->firstName,
            'surname' => fake()->lastName,
            'vat_number' => fake()->bothify('??#####'),
            'company' => fake()->company,
        ];
        //Pro forma
        $this->actingAs($user)->get('admin/users/'.$user->id);

        $response = $this->actingAs($user)->put('admin/users/'.$user->id, $updatedData);

        $response->assertSessionHas('msg-success', 'Profile updated!');

        $updatedUser = User::find($user->id);
        $this->assertEquals($updatedData['name'], $updatedUser->name);
        $this->assertEquals($updatedData['surname'], $updatedUser->surname);
        $this->assertEquals($updatedData['vat_number'], $updatedUser->vat_number);
        $this->assertEquals($updatedData['company'], $updatedUser->company);
    }

    public function testDestroy()
    {
        // Seed the database with a test user
        /** @var User $user */
        $user = User::factory()->create();

        $userController = new UserController();
        $userController->destroy($user);

        $deletedUser = User::find($user->id);
        $this->assertNull($deletedUser);
    }
}
