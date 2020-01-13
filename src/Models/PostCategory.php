<?php

namespace Water\Vular\Webadmin\Models;

use Illuminate\Database\Eloquent\Model;
use Water\Vular\Webadmin\Models\SlugFindable;
use Water\Vular\Models\VularTree;

class PostCategory extends Model{
	use VularTree, SlugFindable;


    public function posts(){
        return $this->belongsToMany('Water\Vular\Webadmin\Models\Post');
    }
}
