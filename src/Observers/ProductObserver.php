<?php

namespace Water\Vular\Webadmin\Observers;

use Water\Vular\Webadmin\Models\Product;
use Water\Vular\Webadmin\Models\FulltextContent;

/**
    retrieved
    creating
    created
    updating
    updated
    saving
    saved
    deleting
    deleted
    restoring
    restored
*/
class ProductObserver{

    public function created(Product $product){
        if($product->status==='1-not-publish') return;
        $content = new FulltextContent;
        $this->saveContent($content, $product);

    }

    public function updating(Product $product){
        if($product->status==='1-not-publish') {
            $this->deleted($product);
            return;
        }

        $content = FulltextContent::where('content_id', $product->id)
                          ->where('model_class', Product::class)
                          ->first();
        $content = $content ? $content : new FulltextContent;

        $this->saveContent($content, $product);
    }

    public function deleted(Product $product){
        $content = FulltextContent::where('content_id', $product->id)
                          ->where('model_class', Product::class);
        if($content){
            $content->delete();

        }
    }

    protected function saveContent($content, $product){
        $content->title = $product->name;
        $content->content_id = $product->id;
        $content->model_class = Product::class;
        $content->content = $product->name
               . ' ' . $product->hscode
               . ' ' . $product->cas_no
               . ' ' . strip_tags( $product->summary)
               . ' ' . strip_tags( $product->description)
               . ' ' . strip_tags( $product->additional_information);
        $content->save();
    }

}