<?php

namespace Tests\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\ServerAssetController;
use App\Models\ServerAsset;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServerAssetControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        // Authenticate a user for the test
        /** @var User $user */
        $user = User::factory()->create();
        $user->role = UserRoleEnum::Admin;
        $this->actingAs($user);
    }

    public function testIndex()
    {
        $response = $this->get('/admin/server_assets');

        $response->assertStatus(200);
        $response->assertViewIs('admin.server_assets.index');
    }

    public function testCreate()
    {
        $response = $this->get('/admin/server_assets/create');

        $response->assertStatus(200);
        $response->assertViewIs('admin.server_assets.create');
    }

    public function testStore()
    {
        dd($this->faker->words);
        $data = [
            'nick_name' => $this->faker->word,
            'local_ip' => $this->faker->ipv4,
            'public_ip' => $this->faker->ipv4,
            'applications' => $this->faker->words,
            'tags' => $this->faker->words,
        ];

        $response = $this->post('/admin/server_assets', $data);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/server_assets');
        $this->assertDatabaseHas('server_assets', $data);
    }

    public function testShow()
    {
        $server_asset = ServerAsset::factory()->create();

        $response = $this->get("/admin/server_assets/{$server_asset->id}");

        $response->assertStatus(200);
        $response->assertViewIs('admin.server_assets.show');
        $response->assertViewHas('serverAsset');
    }

    public function testEdit()
    {
        $server_asset = ServerAsset::factory()->create();

        $response = $this->get("/admin/server_assets/{$server_asset->id}/edit");

        $response->assertStatus(200);
        $response->assertViewIs('admin.server_assets.edit');
        $response->assertViewHas('serverAsset');
    }

    public function testUpdate()
    {
        $server_asset = ServerAsset::factory()->create();
        $data = [
            'nick_name' => $this->faker->word,
            'local_ip' => $this->faker->ipv4,
            'public_ip' => $this->faker->ipv4,
            'applications' => $this->faker->sentence,
            'tags' => $this->faker->words,
        ];

        $response = $this->put("/admin/server_assets/{$server_asset->id}", $data);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/server_assets');
        $this->assertDatabaseHas('server_assets', $data);
    }

    public function testDestroy()
    {
        $server_asset = ServerAsset::factory()->create();

        $response = $this->delete("/admin/server_assets/{$server_asset->id}");

        $response->assertStatus(302);
        $response->assertRedirect('/admin/server_assets');
        $this->assertDatabaseMissing('server_assets', ['id' => $server_asset->id]);
    }
}
