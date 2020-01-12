<?php
namespace Water\Vular\Post\Pages;

use Water\Vular\Admin\Templates\SimpleFormPage;
use Water\Vular\Elements\Vuetify\VTextField;

class TagEdit extends SimpleFormPage{
    protected $modelClass = \Water\Vular\Post\Models\PostTag::class;
    protected $newTitle = '新建标签';
    protected $editTitle = '编辑标签';

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('网站管理')
                    ->textItem('文章管理')
                    ->textItem('标签管理');
    }

    function fields(){
        return [
            VTextField::make()
                ->field('name')
                ->label('标签')
                ->requried()
                ->unique()
        ];
    }

}