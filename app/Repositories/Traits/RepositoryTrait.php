<?php

namespace app\Repositories\Traits;

use App\Models\User;


trait RepositoryTrait
{
    private function getUserAuth(): User
    {
        return User::first();
    }
}
