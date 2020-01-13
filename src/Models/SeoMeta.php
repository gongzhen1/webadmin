<?php

namespace Water\Vular\Webadmin\Models;

use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{

    public function post()
    {
        return $this->belongsTo('Water\Vular\Models\Post');
    }

}
