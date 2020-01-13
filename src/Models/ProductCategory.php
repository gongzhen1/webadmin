<?php

namespace Water\Vular\Webadmin\Models;

use Illuminate\Database\Eloquent\Model;
use Water\Vular\Models\VularTree;

class ProductCategory extends Model{
	use VularTree, SlugFindable;


    public function products(){
        return $this->belongsToMany('Water\Vular\Models\Product');
    }

}
