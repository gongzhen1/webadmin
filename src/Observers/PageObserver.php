<?php

namespace Water\Vular\Webadmin\Observers;

use Water\Vular\Webadmin\Models\Page;
use Water\Vular\Webadmin\Models\FulltextContent;

class PageObserver{

    public function created(Page $page){
        $content = new FulltextContent;
        $content->title = $page->title;
        $content->content_id = $page->id;
        $content->model_class = Page::class;
        $content->content = $page->title
                            . ' ' . strip_tags( $page->summary)
                            . ' ' . strip_tags( $page->content);

        $content->save();

    }

    public function updating(Page $page){
        $content = FulltextContent::where('content_id', $page->id)
                          ->where('model_class', Page::class)
                          ->first();
        $content = $content ? $content : new FulltextContent;
        $content->title = $page->title;
        $content->content_id = $page->id;
        $content->model_class = Page::class;
        $content->content = $page->title
                            . ' ' . strip_tags( $page->summary)
                            . ' ' . strip_tags( $page->content);

        $content->save();
    }

    public function deleted(Page $page){
        $content = FulltextContent::where('content_id', $page->id)
                          ->where('model_class', Page::class);
        if($content){
            $content->delete();

        }
    }

}