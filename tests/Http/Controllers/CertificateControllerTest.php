<?php

namespace Tests\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Models\Certificate;
use App\Models\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Mockery;
use Tests\TestCase;

class CertificateControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        // Authenticate a user for the test
        $user = User::factory()->create();
        $user->role = UserRoleEnum::Admin;
        $this->actingAs($user);
    }

    public function testPopolateDb()
    {
        Storage::fake()->put(config('filesystems.key_file'), 'V	250714011809Z		98CE8C26EA5C8578C39536810591B1ED	unknown	/CN=openvpn'.PHP_EOL.
            'V	250715013823Z		51A14DD8E7C57B0928A099EEC32C1266	unknown	/CN=Lars'.PHP_EOL.
            'R	250715033213Z	230412075224Z	D295A7253593A2220C3AB8552786402D	unknown	/CN=Torben'.PHP_EOL.
            'R	250715075445Z	230412094038Z	4C084FB6F49FDBC5BCE26FF26AC23529	unknown	/CN=Torben'.PHP_EOL.
            'R	250715093037Z	230412093448Z	A47E60093E8C34A5198995E69F5DACBA	unknown	/CN=Bof'.PHP_EOL.
            'V	250715094053Z		A2C927589F833D7EE887AEB51A4AB7D8	unknown	/CN=Torben'.PHP_EOL);

        $response = $this->get('admin/popolate_db');
        $response->assertStatus(200);
        $response->assertViewIs('admin.readdb');
    }

    public function testDownload()
    {
        Storage::fake('ca');
        // Create a Certificate for the test
        /** @var Certificate $certificate */
        $certificate = Certificate::factory()->create();

        $fileName = sprintf('%s.ovpn', $certificate->strippedUserName);
        Storage::disk('pki')->put($fileName, 'content');

        $this->instance(
            ResponseFactory::class, Mockery::mock(ResponseFactory::class, function ($mock) use ($fileName) {
            $mock->shouldReceive('download')
                ->with(Storage::disk('pki')->path($fileName))
                ->andReturn(Storage::disk('pki')->download($fileName));
        }));

        $response = $this->get('/admin/download/'.$certificate->id);

        $response->assertStatus(200);
    }

    public function testRevoke()
    {
        // Create a Certificate for the test
        /** @var Certificate $certificate */
        $certificate = Certificate::factory()->create();

        Redis::shouldReceive('publish')->once();

        $response = $this->get('/admin/revokecert/'.$certificate->id);

        $response->assertRedirect(route('admin.admin_showuserfromname', ['name' => $certificate->user->user_name]));
        $response->assertSessionHas('msg-success', 'Profile updated!');
    }

    public function testRelease()
    {
        // Create a User for the test
        /** @var User $user */
        $user = User::factory()->create();

        Redis::shouldReceive('publish')->once();

        $this->get('/admin/showuserfromname/'.$user->user_name);
        $response = $this->get('/admin/releasecert/'.$user->id);

        $response->assertRedirect(route('admin.admin_showuserfromname', ['name' => $user->user_name]));
        $response->assertSessionHas('msg-success', 'Profile updated!');
    }
}
