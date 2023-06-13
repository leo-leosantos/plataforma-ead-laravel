<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ModuleResource;
use App\Repositories\ModuleRepository;

class ModuleController extends Controller
{
    protected $repository;

    public function __construct(ModuleRepository $courseRepository)
    {
             $this->repository = $courseRepository;
    }

    public function index($courseId)
    {
       $modules = $this->repository->getModulesByCourseId($courseId);

       return ModuleResource::collection($modules);

    }
}
