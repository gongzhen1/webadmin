<?php
namespace Water\Vular\Webadmin\Form;

use Water\Vular\Admin\Menu\Segment as MenuSegment;

class Menu extends MenuSegment{

	function build(){
        $this->node(function($node){
            $node->becomeToGroup('询盘管理')
                ->icon('email')
                ->child(function($child){
                    $child->becomeToTile('询盘')
                        ->to(InquiryList::make());
                })
                ->child(function($child){
                    $child->becomeToTile('垃圾箱')
                        ->to(SpamList::make());
                })
                ->child(function($child){
                    $child->becomeToTile('拦截设置')
                        ->to(Antispam::make());
                })
                ;
        });

	}

}