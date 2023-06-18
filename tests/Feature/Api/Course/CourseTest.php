<?php

namespace Tests\Feature\Api\Course;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Api\UtilsTrait;
use Tests\TestCase;

class CourseTest extends TestCase
{

    use UtilsTrait;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_unauthenticated()
    {

        $response = $this->getJson('/courses');
        $response->assertStatus(401);
    }


    public function test_get_all_courses()
    {

        $response = $this->getJson('/courses', $this->defaultHeaders());
        $response->assertStatus(200);
    }

    public function test_get_all_courses_total()
    {

         Course::factory()->count(10)->create();
        $response = $this->getJson('/courses', $this->defaultHeaders());
        $response->assertStatus(200)->assertJsonCount( 10, 'data');
    }

    public function test_get_single_courses_unauthenticated()
    {
        $response = $this->getJson('/courses/fake_id');
        $response->assertStatus(401);
    }


    public function test_get_single_courses_not_found()
    {
        $response = $this->getJson('/courses/fake_id', $this->defaultHeaders());
        $response->assertStatus(404);
    }

    public function test_get_single_courses_by_id()
    {


        $course = $this->createCourseFactory();
        $response = $this->getJson("/courses/{$course->id}", $this->defaultHeaders());
        $response->assertStatus(200);
    }
}
