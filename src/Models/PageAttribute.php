<?php

namespace Water\Vular\Webadmin\Models;

use Illuminate\Database\Eloquent\Model;

class PageAttribute extends Model{
    use SlugFindable;
    public function pages()
    {
        return $this->belongsToMany('Water\Vular\Webadmin\Models\Page')->orderBy('order')->orderBy('created_at', 'desc');
    }

}
