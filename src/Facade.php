<?php
namespace Laravolt\Epicentrum;

class Facade extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'epicentrum';
    }
}
