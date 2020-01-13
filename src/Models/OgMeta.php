<?php

namespace Water\Vular\Webadmin\Models;

use Illuminate\Database\Eloquent\Model;

class OgMeta extends Model{

    public function media(){
         return $this->belongsTo('Water\Vular\Models\Media');
    }

}
