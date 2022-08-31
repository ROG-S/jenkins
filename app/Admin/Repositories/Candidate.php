<?php

namespace App\Admin\Repositories;

use App\Models\Candidate as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Candidate extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
