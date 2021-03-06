<?php
namespace Water\Vular\Post;

use Water\Vular\Admin\Menu\Segment as MenuSegment;
use Water\Vular\Post\Pages\PostList;
use Water\Vular\Post\Pages\CategoriesPage;
use Water\Vular\Post\Pages\TagList;
use Water\Vular\Post\Pages\AttributeList;

class Menu extends MenuSegment{

	function build(){
        $this->node(function($node){
            $node->becomeToGroup(trans('vular.posts'))
                ->icon('library_books')
                ->child(function($child){
                    $child->becomeToTile(trans('vular.all-posts'))
                        ->to(PostList::make());
                })
                //->child(function($child){
                //    $child->becomeToTile(trans('vular.drafts'))
                //        ->to(DraftList::make());
                //})
                ->child(function($child){
                    $child->becomeToTile(trans('vular.categories'))
                        ->to(CategoriesPage::make());
                })
                ->child(function($child){
                    $child->becomeToTile(trans('vular.tags'))
                        ->to(TagList::make());
                })
                ->child(function($child){
                    $child->becomeToTile(trans('vular.attributes'))
                        ->to(AttributeList::make());
                })
                ;
        });

	}

}