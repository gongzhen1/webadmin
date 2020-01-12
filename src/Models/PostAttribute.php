<?php

namespace Water\Vular\Post\Models;

use Illuminate\Database\Eloquent\Model;

class PostAttribute extends Model
{
    public function posts()
    {
        return $this->belongsToMany('Water\Vular\Models\Post');
    }

}
