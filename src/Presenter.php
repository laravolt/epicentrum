<?php

namespace Laravolt\Epicentrum;

use Laravolt\Epicentrum\Transformers\UserTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class Presenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UserTransformer();
    }
}
