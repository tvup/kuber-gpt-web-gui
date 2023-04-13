<?php

namespace Tests\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Models\ServerAsset;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
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
        ServerAsset::truncate();

        $nick_name = $this->faker->word;
        $ipv4 = $this->faker->ipv4;
        $ipv41 = $this->faker->ipv4;
        $applications = [['name' => 'app1', 'url' => 'http://www.test1.dk'], ['name' => 'app2', 'url' => 'http://www.test2.dk'], ['name' => 'app4', 'url' => 'http://www.test3.dk']];
        $applications2 = [['url' => 'http://www.test1.dk', 'name' => 'app1'], ['url' => 'http://www.test2.dk', 'name' => 'app2'], ['url' => 'http://www.test3.dk', 'name' => 'app4']];
        $tags = [$this->faker->word, $this->faker->word, $this->faker->word];

        $data = [
            'nick_name' => $nick_name,
            'local_ip' => $ipv4,
            'public_ip' => $ipv41,
            'applications' => $applications,
            'tags' => $tags,
        ];

        $data2 = [
            'nick_name' => $nick_name,
            'local_ip' => $ipv4,
            'public_ip' => $ipv41,
            'applications' => $this->transMoGrif(json_encode($applications2, JSON_UNESCAPED_SLASHES)),
            'tags' => $this->transMoGrif(json_encode($tags)),
        ];

        $response = $this->post('/admin/server_assets', $data);
        $response->assertStatus(302);
        $response->assertRedirect('/admin/server_assets');
        //$this->assertDatabaseHas('server_assets', $data2);
    }

    private function transMoGrif($input)
    {
        return Str::replace(',', ', ', Str::replace('":', '": ', $input));
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

        $applications = [['name' => 'app1', 'url' => 'http://www.test1.dk'], ['name' => 'app2', 'url' => 'http://www.test2.dk'], ['name' => 'app4', 'url' => 'http://www.test3.dk']];
        $tags = [$this->faker->word, $this->faker->word, $this->faker->word];

        $data = [
            'nick_name' => $this->faker->word,
            'local_ip' => $this->faker->ipv4,
            'public_ip' => $this->faker->ipv4,
            'applications' => $applications,
            'tags' => $tags,
        ];

        $response = $this->put("/admin/server_assets/{$server_asset->id}", $data);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/server_assets');
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
