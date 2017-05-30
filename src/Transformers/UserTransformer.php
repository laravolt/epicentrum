<?php
namespace Laravolt\Epicentrum\Transformers;

use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{

    /**
     * Transform the \User entity
     * @param User $model
     * @return array
     */
    public function transform(Model $model)
    {
        return [
            'id'         => (int)$model->id,
            'name'       => $model->name,
            'email'      => $model->email,
            'status'     => $model->status,
            'timezone'   => $model->timezone,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
            'avatar'     => $model->getAvatar()
        ];
    }
}
