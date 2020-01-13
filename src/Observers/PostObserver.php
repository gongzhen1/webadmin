<?php

namespace Water\Vular\Webadmin\Observers;

use Water\Vular\Webadmin\Models\Post;
use Water\Vular\Webadmin\Models\FulltextContent;

class PostObserver{

    public function created(Post $post){
        if($post->status==='1-not-publish') return;
        $content = new FulltextContent;
        $content->title = $post->title;
        $content->content_id = $post->id;
        $content->model_class = Post::class;
        $content->content = $post->title
                            . ' ' . strip_tags( $post->summary)
                            . ' ' . strip_tags( $post->content);

        $content->save();

    }

    public function updating(Post $post){
        if($post->status==='1-not-publish') {
            $this->deleted($post);
            return;
        }
        $content = FulltextContent::where('content_id', $post->id)
                          ->where('model_class', Post::class)
                          ->first();
        $content = $content ? $content : new FulltextContent;
        $content->title = $post->title;
        $content->content_id = $post->id;
        $content->model_class = Post::class;
        $content->content = $post->title
                            . ' ' . strip_tags( $post->summary)
                            . ' ' . strip_tags( $post->content);

        $content->save();
    }

    public function deleted(Post $post){
        $content = FulltextContent::where('content_id', $post->id)
                          ->where('model_class', Post::class);
        if($content){
            $content->delete();

        }
    }

}