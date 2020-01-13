<?php

namespace Water\Vular\Webadmin\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerCase extends Model{
    use \Water\Vular\Models\SlugFindable;

    public function featureImage(){
        return $this->belongsTo('Water\Vular\Models\Media');
    }

    public function medias(){
        return $this->belongsToMany('Water\Vular\Models\Media', 'customer_case_medias')
        	->withPivot('order','alt_text')->orderBy('customer_case_medias.order');
    }

    //public function avatar(){
    //    $avatar = $this->avatarMedia;
    //    return $avatar ? $avatar->fitName(350,350) : 'avatar-blank.jpg';
    //}

    public function featureMedia(){
        $media = $this->featureImage;
        $size = page_media_size();
        return $media ? $media->fitName($size) : 'post-blank.jpg';
    }

    public function featureThumbnail(){
        $media = $this->featureImage;
        $size = page_media_thumb_size();
        return $media ? $media->fitName($size) : 'post-blank.jpg';
    }

    public function seoMeta(){
        return $this->hasOne('Water\Vular\Models\SeoMeta');
    }

    public function ogMeta(){
        return $this->hasOne('Water\Vular\Models\OgMeta');
    }

}
