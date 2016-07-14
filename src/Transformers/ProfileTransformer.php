<?php
namespace Laravolt\Epicentrum\Transformers;

use League\Fractal\TransformerAbstract;
use Laravolt\Epicentrum\Models\Profile;

/**
 * Class ProfileTransformer
 * @package namespace App\Transformers;
 */
class ProfileTransformer extends TransformerAbstract
{

    /**
     * Transform the \Profile entity
     * @param Profile $model
     * @return array
     */
    public function transform(Profile $model)
    {
        return [
            'id'       => (int)$model->id,
            'bio'      => $model->bio,
            'timezone' => $model->timezone,

            'tempat_lahir'  => $model->tempat_lahir,
            'tanggal_lahir' => $model->tanggal_lahir,
            'dapil'         => $model->dapil,
            'fraksi'        => $model->fraksi,
            'jabatan'       => $model->jabatan,
            'keterangan'    => $model->keterangan,
            'kabupaten'     => $model->kabupaten,
            'provinsi'      => $model->provinsi,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
