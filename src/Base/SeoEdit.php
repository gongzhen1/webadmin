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
use Water\Vular\Elements\Vular\VularLabel;
use Water\Vular\Admin\FormDialog;

class SeoEdit extends FormDialog{
    //use Form;
    //protected $modelClass = \Water\Vular\Models\SeoMeta::class;
    protected $title = "SEO Meta 设置";
    //protected $modelClass = \Water\Vular\Models\SeoMeta::class;
    public function __construct(){
        parent::__construct();
        //$this->async(\Water\Vular\Models\SeoMeta::class);
    }

    function createActivator(){
        return  VBtn::make()
                ->slot('activator')
                ->children(
                    VIcon::make('trending_up')
                        ->left()
                )
                ->text('SEO Meta')
                ->flat();
    }

    function contentPanel(){
        return Div::make()->children(
            Div::make('预览')
                ->style('color:#9e9e9e'),
            VularLabel::make()
                ->field('title')
                ->style('color:#1A0DAB;font-size:18px;')
                ->class('pb-1')
                ->maxLength(65),
            VularLabel::make()
                ->style('font-size:14px;color:#006621')
                ->class('pb-1')
                ->maxLength(73)
                ->defaultValue('https://your-website-domain.com/slug'),
            VularLabel::make()
                ->field('description')
                ->style('font-size:13px;color:#545454')
                ->class('pb-3')
                ->maxLength(163),
            VDivider::make()
                ->class('mb-3'),
            //->field('vularValid')
            //->props('ref',$this->vularId())
            //->ref($this->vularId())
            VTextField::make()
                ->field('title')
                ->requried()
                ->label('Title'),
            VTextArea::make()
                ->field('description')
                ->label('Description')
                ->rows(2)
        );
    }



}