<?php

namespace Water\Vular\Post\Models;

use Illuminate\Database\Eloquent\Model;
use Water\Vular\Models\SlugFindable;
use Water\Vular\Models\VularTree;

class PostCategory extends Model{
	use VularTree, SlugFindable;


    public function posts(){
        return $this->belongsToMany('Water\Vular\Models\Post');
    }
}
