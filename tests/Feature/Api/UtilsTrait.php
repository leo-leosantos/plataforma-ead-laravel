<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Course;

trait UtilsTrait

{

    public function createUser()
    {
        $user = User::factory()->create();

        return $user;

    }
    public function createTokenUser()
    {

        $user = $this->createUser();
        $token = $user->createToken('test')->plainTextToken;

        return $token;
    }


    public function defaultHeaders()
    {
        $token = $this->createTokenUser();
        return [
            'Authorization' => "Bearer {$token}"
        ];
    }
    public function createCourseFactory()
    {
        $course = Course::factory()->create();

        return $course;
    }

}
