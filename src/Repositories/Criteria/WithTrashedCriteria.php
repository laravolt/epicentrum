<?php

namespace Laravolt\Epicentrum\Repositories\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class WithTrashedCriteria implements CriteriaInterface
{
    public function apply($model, RepositoryInterface $repository)
    {
        $withTrashed = (bool)request('trashed');

        if ($withTrashed) {
            return $model->withTrashed();
        }

        return $model;
    }
}
