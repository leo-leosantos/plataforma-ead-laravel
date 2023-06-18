<?php

namespace Tests\Feature\Api\Support;

use App\Models\Support;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Api\UtilsTrait;

class SupportTest extends TestCase
{

    use UtilsTrait;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_my_supports_unauthenticated()
    {
        $response = $this->getJson('/my-supports');

        $response->assertStatus(401);
    }
    public function test_get_my_supports()
    {
        $user = $this->createUser();
        $token = $user->createToken('test')->plainTextToken;

        Support::factory()->count(50)->create([
            'user_id' => $user->id
        ]);
        Support::factory()->count(50)->create();
        $response = $this
        ->getJson('/my-supports', ['Authorization' => "Bearer {$token} "]);

        $response->assertStatus(200)->assertJsonCount(50, 'data');
    }
}
