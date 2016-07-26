<?php

namespace Laravolt\Epicentrum\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'user_profiles';

    protected $fillable = [
        'user_id',
        'bio',
        'timezone',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
