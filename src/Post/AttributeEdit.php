<?php
namespace Water\Vular\Webadmin\Post;

use Water\Vular\Admin\Templates\SimpleFormPage;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vular\VularSlug;

class AttributeEdit extends SimpleFormPage{
    protected $modelClass = \Water\Vular\Webadmin\Models\PostAttribute::class;
    protected $newTitle = '新建属性';
    protected $editTitle = '编辑属性';

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('网站管理')
                    ->textItem('文章管理')
                    ->textItem('属性管理');
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
                ->unique()
        ];
    }

}