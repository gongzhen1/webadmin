<?php
namespace Water\Vular\Webadmin\Product;

use Water\Vular\Admin\Menu\Segment as MenuSegment;

class Menu extends MenuSegment{

	function build(){
        $this->node(function($node){
            $node->becomeToGroup(trans('vular.products'))
                ->icon('redeem')
                ->child(function($child){
                    $child->becomeToTile(trans('vular.all-products'))
                        ->to(ProductList::make());
                })
                ->child(function($child){
                    $child->becomeToTile(trans('vular.categories'))
                        ->to(CategoriesPage::make());
                })
                ->child(function($child){
                    $child->becomeToTile(trans('vular.attributes'))
                        ->to(AttributeList::make());
                })
                ;
        });

	}

}