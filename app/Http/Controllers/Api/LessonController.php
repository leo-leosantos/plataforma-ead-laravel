<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\LessonRepository;
use App\Http\Resources\LessonResource;

class LessonController extends Controller
{
    protected $repository;

    public function __construct(LessonRepository $lessonRepository)
    {
        $this->repository = $lessonRepository;
    }

    public function index($moduleId)
    {

        $lessons = $this->repository->getLessonsByModuleId($moduleId);

        return LessonResource::collection($lessons);
    }

    public function show($id)
    {
        return new LessonResource($this->repository->getLesson($id));
    }
}
