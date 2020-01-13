<?php
namespace Water\Vular\Webadmin\Page;

use Water\Vular\Admin\Menu\Segment as MenuSegment;

class Menu extends MenuSegment{

	function build(){
        $this->node(function($node){
            $node->becomeToSubheader('网站管理');
        });

        $this->node(function($node){
            $node->becomeToGroup(trans('vular.appearance'))
                ->icon('pages')
                ->child(function($child){
                    $child->becomeToTile(trans('vular.pages'))
                        ->to(PageList::make());
                })
                ->child(function($child){
                    $child->becomeToTile(trans('vular.page-categories'))
                        ->to(CategoryList::make());
                })
                ->child(function($child){
                    $child->becomeToTile(trans('vular.page-attributes'))
                        ->to(AttributeList::make());
                })


                //->child(function($child){
                //    $child->becomeToTile(trans('vular.main-menu'))
                //        ->to(MainMenuPage::make());
                //})
               //->child(function($child){
                //    $child->becomeToTile(trans('vular.sub-menus'))
                //        ->to(SubMenuList::make());
                //})
                ;
        });

	}

}