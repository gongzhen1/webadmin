<?php
namespace Water\Vular\Webadmin\Page;

use Water\Vular\Admin\Templates\SimpleFormPage;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vuetify\VTextArea;
use Water\Vular\Elements\Vular\VularSlug;

class CategoryEdit extends SimpleFormPage{
    protected $modelClass = \Water\Vular\Webadmin\Models\PageCategory::class;
    protected $newTitle = '新建分类';
    protected $editTitle = '编辑分类';

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('网站管理')
                    ->textItem('页面管理')
                    ->textItem('分类管理');
    }

    function fields(){
        return [
            VularSlug::make()
                ->field('slug')
                ->label('标识')
                ->requried()
                ->unique(),
            VTextField::make()
                ->field('name')
                ->label('名称')
                ->requried()
                ->unique(),
            VTextArea::make()
                ->field('description')
                ->label('描述')
        ];
    }

}