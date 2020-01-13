<?php

namespace Water\Vular\Webadmin\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model{
    use SlugFindable;
    //public function slug(){
    //     return $this->hasOne('Water\Vular\Models\Slug');
    //}
    
    public function user(){
         return $this->belongsTo('Water\Vular\Models\Admin');
    }

    public function attributes(){
        return $this->belongsToMany('Water\Vular\Webadmin\Models\ProductAttribute');
    }

    public function categories(){
        return $this->belongsToMany('Water\Vular\Webadmin\Models\ProductCategory');
    }

    public function medias(){
        return $this->belongsToMany('Water\Vular\Models\Media', 'product_media')
        	->withPivot('order','alt_text')->orderBy('product_media.order');
    }

    public function seoMeta(){
        return $this->hasOne('Water\Vular\Webadmin\Models\SeoMeta');
    }

    public function ogMeta(){
        return $this->hasOne('Water\Vular\Webadmin\Models\OgMeta');
    }

    public function relatedProducts(){
        return $this->belongsToMany('Water\Vular\Webadmin\Models\Product','product_product', 'product1_id', 'product2_id');
    }

    public function featureThumbnail(){
        $media = $this->medias()->first();
        
        return $media ? $media->fitName([260,230]) : 'blank.jpg';
    }

    public function featureSmallThumbnail(){
        $media = $this->medias()->first();
        
        return $media ? $media->fitName([130,115]) : 'blank.jpg';
    }

}
