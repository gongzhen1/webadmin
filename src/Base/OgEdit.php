<?php
namespace Water\Vular\Webadmin\Base;

use Water\Vular\Elements\Html\Div;
use Water\Vular\Elements\Vuetify\VLayout;
use Water\Vular\Elements\Vuetify\VFlex;
use Water\Vular\Elements\Vuetify\VCard;
use Water\Vular\Elements\Vuetify\VCardText;
use Water\Vular\Elements\Vuetify\VDivider;
use Water\Vular\Elements\Vuetify\VToolbar;
use Water\Vular\Elements\Vuetify\VToolbarTitle;
use Water\Vular\Elements\Vuetify\VForm;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vuetify\VTextArea;
use Water\Vular\Elements\Vuetify\VBtn;
use Water\Vular\Elements\Vuetify\VIcon;
use Water\Vular\Elements\Vular\VularAvatar;
use Water\Vular\Admin\FormDialog;

class OgEdit extends FormDialog{
    protected $title = "OG Meta 设置";
    public function __construct(){
        parent::__construct();
        //$this->sync();
    }

    function createActivator(){
        return  VBtn::make()
                ->slot('activator')
                ->children(
                    VIcon::make('share')
                        ->left()
                )
                ->text('OG Meta')
                ->flat();
    }

    function contentPanel(){
        return VLayout::make()
            ->column()
            ->children(
                VFlex::make()
                    ->children(
                        //VTextField::make()
                        //    ->field('type')
                        //    ->label('Type'),
                        VTextField::make()
                            ->field('title')
                            ->label('标题'),
                        VTextArea::make()
                            ->field('description')
                            ->label('描述')
                            ->rows(2)
                    ),
                VFlex::make()
                    ->children(
                        VLayout::make()
                            ->row()
                            ->children(
                                VFlex::make()
                                    ->class('xs4')
                                    ->children(
                                        VularAvatar::make()
                                            ->field('media')
                                            ->addSize([952,635])
                                            ->label('特色图')
                                    ),
                                VFlex::make()
                                    ->class('xs8')
                                    ->children(
                                        VTextField::make()
                                            ->field('image_width')
                                            ->label('宽度')
                                            ->setBlankValue(952)
                                            ->saveFilter(function($value){
                                                return $value ? $value : 952;
                                            })
                                            ,
                                        VTextField::make()
                                            ->field('image_height')
                                            ->label('高度')
                                            ->setBlankValue(635)
                                            ->saveFilter(function($value){
                                                return $value ? $value : 635;
                                            })
                                            
                                    )
                            )
                )/*,                
                VFlex::make()
                    ->children(
                        VTextField::make()
                            ->field('site_name')
                            ->label('Site Name'),
                        VTextField::make()
                            ->field('url')
                            ->label('Url')
                    )*/
        );
    }


}