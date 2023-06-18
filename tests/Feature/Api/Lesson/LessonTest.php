<?php

namespace Tests\Feature\Api\Lesson;

use Tests\TestCase;
use App\Models\Lesson;
use App\Models\Module;
use Tests\Feature\Api\UtilsTrait;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LessonTest extends TestCase
{
    use UtilsTrait;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_lessons_unauthenticated()
    {
        $response = $this->getJson('/modules/fake_id/lessons');

        $response->assertStatus(401);
    }

    public function test_get_lessons_of_module_not_found()
    {
        $response = $this->getJson('/modules/fake_id/lessons', $this->defaultHeaders());
        $response->assertStatus(200)->assertJsonCount(0,'data');
    }

    public function test_get_lessons_module()
    {
        $course = $this->createCourseFactory();

        $response = $this->getJson("/modules/{$course->id}/lessons", $this->defaultHeaders());
        $response->assertStatus(200);
    }

  

    public function test_get_lessons_of_modules_total()
    {
        $module = Module::factory()->create();
        Lesson::factory()->count(10)->create([
            'module_id' =>$module->id
        ]);

        $response = $this->getJson("/modules/{$module->id}/lessons", $this->defaultHeaders());
        $response->assertStatus(200)->assertJsonCount(10,'data');
    }


    public function test_get_single_unauthenticated()
    {

        $response = $this->getJson('/lessons/fake_id');
        $response->assertStatus(401);
    }

    public function test_get_single_not_found()
    {

        $response = $this->getJson('/lessons/fake_id', $this->defaultHeaders());
        $response->assertStatus(404);
    }

    public function test_get_single_lesson()
    {
        $lesson = Lesson::factory()->create();

        $response = $this->getJson("/lessons/{$lesson->id}", $this->defaultHeaders());
        $response->assertStatus(200);
    }
}
