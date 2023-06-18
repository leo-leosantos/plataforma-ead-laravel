<?php

namespace Tests\Feature\Api\Modules;

use Tests\TestCase;
use App\Models\Module;
use Tests\Feature\Api\UtilsTrait;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModuleTest extends TestCase
{
    use UtilsTrait;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_modules_unauthenticated()
    {
        $response = $this->getJson('/courses/fake_id/modules');

        $response->assertStatus(401);
    }

    public function test_get_modules_course_not_found()
    {
        $response = $this->getJson('/courses/fake_id/modules', $this->defaultHeaders());
        $response->assertStatus(200)->assertJsonCount(0,'data');
    }

    public function test_get_modules_course()
    {
        $course = $this->createCourseFactory();

        $response = $this->getJson("/courses/{$course->id}/modules", $this->defaultHeaders());
        $response->assertStatus(200);
    }

    public function test_get_modules_course_total()
    {
        $course = $this->createCourseFactory();


        Module::factory()->count(10)->create([
            'course_id' =>$course->id
        ]);

        $response = $this->getJson("/courses/{$course->id}/modules", $this->defaultHeaders());
        $response->assertStatus(200)->assertJsonCount(10,'data');
    }
}
