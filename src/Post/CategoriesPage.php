<?php
namespace Water\Vular\Webadmin\Post;

use Water\Vular\Admin\Templates\TreeEditPage;
use Water\Vular\Elements\Vuetify\VLayout;
use Water\Vular\Elements\Vuetify\VFlex;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vuetify\VTextArea;
use Water\Vular\Elements\Vular\VularTreeEditor;

class CategoriesPage extends TreeEditPage{
    protected $title = '文章分类';
    protected $modelClass = \Water\Vular\Webadmin\Models\PostCategory::class;

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('网站管理')
                    ->textItem('文章管理')
                    ->textItem('文章分类');

        $this->editor->flex(
                VTextField::make()
                    ->field('name')
                    ->label('名称')
                    ->maxLength(20)
            )
            ->flex(
                VTextField::make()
                    ->field('slug')
                    ->label('Slug')
                    ->requried()
                    ->unique()
                    ->maxLength(20)
            )
            ->flex(
                VTextArea::make()
                    ->field('description')
                    ->label('描述')
                    ->maxLength(1000)
            );
    }


}