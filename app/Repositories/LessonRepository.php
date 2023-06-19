<?php

namespace App\Repositories;

use App\Models\View;
use App\Models\Lesson;
use App\Repositories\Traits\RepositoryTrait;

class LessonRepository
{

    use RepositoryTrait;
    protected $entity;

    public function __construct(Lesson $model)
    {
        $this->entity = $model;
    }

    public function getLessonsByModuleId(string $moduleId)
    {
        return $this->entity->with('supports.replies')
            ->where('module_id', $moduleId)->get();
    }

    public function getLesson(string $identify)
    {
        return $this->entity->findOrFail($identify);
    }


    public function markLessonViewed(string $lessonId)
    {
        $user = $this->getUserAuth();
        $view = $user->view()->where('lesson_id', $lessonId)->first();

        if ($view) {
            $view->update([
                'qty' => $view->qty + 1,
            ]);
        }
        return $user->view()->create([
            'lesson_id' => $lessonId,
        ]);
    }
}
