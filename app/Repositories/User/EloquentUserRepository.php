<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\EloquentBaseRepository;


class EloquentUserRepository extends EloquentBaseRepository implements UserRepositoryInterface
{

    protected string $model = User::class;

    }
