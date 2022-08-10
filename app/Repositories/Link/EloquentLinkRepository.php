<?php

namespace App\Repositories\Link;

use App\Models\Link;
use App\Repositories\EloquentBaseRepository;


class EloquentLinkRepository extends EloquentBaseRepository implements LinkRepositoryInterface
{

    protected string $model = Link::class;

    }
