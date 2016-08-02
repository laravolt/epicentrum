<?php
namespace Laravolt\Epicentrum\Transformers;

use League\Fractal\TransformerAbstract;
use Laravolt\Epicentrum\Models\User;

class UserTransformer extends TransformerAbstract
{

    /**
     * Transform the \User entity
     * @param User $model
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id'         => (int)$model->id,
            'name'       => $model->name,
            'email'      => $model->email,
            'status'     => $model->status,
            'timezone'   => $model->timezone,
            'created_at' => format_localized($model->created_at),
            'updated_at' => format_localized($model->updated_at),
            'avatar'     => $model->getAvatar(),

            'keterangan' => $model->profile->keterangan ?? '',
        ];
    }

}
