<?php

namespace Water\Vular\Webadmin\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model{
    use SlugFindable;
    //public function slug(){
    //     return $this->hasOne('Water\Vular\Models\Slug');
    //}
    
    public function author(){
         return $this->belongsTo('Water\Vular\Models\Admin');
    }

    public function user(){
         return $this->belongsTo('Water\Vular\Models\Admin');
    }

    public function attributes(){
        return $this->belongsToMany('Water\Vular\Webadmin\Models\PostAttribute');
    }

    public function categories(){
        return $this->belongsToMany('Water\Vular\Webadmin\Models\PostCategory');
    }

    public function tags(){
        return $this->belongsToMany('Water\Vular\Webadmin\Models\PostTag');
    }

    public function medias(){
        return $this->belongsToMany('Water\Vular\Models\Media', 'post_medias')
        	->withPivot('order','alt_text')->orderBy('post_medias.order');
    }

    public function seoMeta(){
        return $this->hasOne('Water\Vular\Webadmin\Models\SeoMeta');
    }

    public function ogMeta(){
        return $this->hasOne('Water\Vular\Webadmin\Models\OgMeta');
    }

    public function relatedProducts(){
        return $this->belongsToMany('Water\Vular\Webadmin\Models\Product');
    }

    public function featureMedia(){
        $media = $this->medias()->first();
        $size = config('vular.post-media-thumb-size');
        return $media ? $media->fitName($size) : 'post-blank.jpg';
    }

    public function featureThumbnail(){
        $media = $this->medias()->first();
        $size = config('vular.post-media-thumb-size');
        \Log::notice($size);
        return $media ? $media->fitName($size) : 'post-blank.jpg';
    }

}
