<?php
namespace Water\Vular\Webadmin\Product;

use Water\Vular\Admin\Templates\TreeEditPage;
use Water\Vular\Elements\Vuetify\VLayout;
use Water\Vular\Elements\Vuetify\VFlex;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vuetify\VTextArea;
use Water\Vular\Elements\Vular\VularTreeEditor;
use Water\Vular\Elements\Vular\VularSlug;

class CategoriesPage extends TreeEditPage{
    protected $title = '产品分类';
    protected $modelClass = \Water\Vular\Webadmin\Models\ProductCategory::class;

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('网站管理')
                    ->textItem('产品管理')
                    ->textItem('产品分类');

        $this->editor
            ->label('产品分类')
            ->flex(
            VTextField::make()
                ->field('name')
                ->label('名称')
                ->maxLength(30)
            )
            ->flex(
            VularSlug::make()
                ->field('slug')
                ->label('Slug')
                ->requried()
                ->unique()
                ->maxLength(30)
            )
            ->flex(
                VTextArea::make()
                    ->field('description')
                    ->label('描述')
                    //->maxLength(1000)
            );
    }


}