<?php

namespace Water\Vular\Webadmin\Models;

trait SlugFindable{
    static function findBySlug($slug){
    	return self::where('slug', $slug)->first();
    }
	
}