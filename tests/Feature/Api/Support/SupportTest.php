<?php

namespace Tests\Feature\Api\Support;

use App\Models\Lesson;
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
        $response = $this->getJson('/my-supports',
         ['Authorization' => "Bearer {$token}"
        ]);

        $response->assertStatus(200)->assertJsonCount(50, 'data');
    }


    public function test_get_supports_unauthenticated()
    {

        $response = $this->getJson('/supports');
        $response->assertStatus(401);
    }

    public function test_get_supports()
    {
        Support::factory()->count(50)->create();

        $response = $this->getJson('/supports', $this->defaultHeaders());
        $response->assertStatus(200)->assertJsonCount(50, 'data');
    }


    public function test_get_supports_filters_lesson()
    {
        Support::factory()->count(50)->create();
        $lesson = Lesson::factory()->create();
        Support::factory()->count(10)->create([
            'lesson_id'=> $lesson->id
        ]);

        $payload = ['lesson'=> $lesson->id];
        $response = $this->json('GET','/supports', $payload,$this->defaultHeaders());
        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }

    public function test_create_support_unauthenticated()
    {
        $response = $this->postJson('/supports');

        $response->assertStatus(401);
    }
    public function test_create_support_error_validations()
    {
        $response = $this->postJson('/supports',[], $this->defaultHeaders());
        $response->assertStatus(422);
    }

    public function test_create_support()
    {
        $lesson = Lesson::factory()->create();
        $payload = [
            'lesson'=> $lesson->id,
            'status'=> 'P',
            'description' =>  'description_teste',
        ];
        $response = $this->postJson('/supports',$payload, $this->defaultHeaders());
        $response->assertStatus(200);
    }


    
}
