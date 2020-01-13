<?php
namespace Water\Vular\Webadmin\Page;

use Water\Vular\Admin\Templates\TreeEditPage;
use Water\Vular\Elements\Vuetify\VLayout;
use Water\Vular\Elements\Vuetify\VFlex;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vuetify\VTextArea;
use Water\Vular\Elements\Vuetify\VSelect;
use Water\Vular\Elements\Vular\VularTreeEditor;

class MainMenuPage extends TreeEditPage{
    protected $title = '主菜单管理';
    protected $modelClass = \Water\Vular\Models\MainMenuItem::class;

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('网站管理')
                    ->textItem('网站外观')
                    ->textItem('主菜单管理');

        $this->editor
            ->itemText('title')
            ->label('菜单项')
            ->flex(
            VTextField::make()
                ->field('title')
                ->label('标题')
                ->maxLength(30)
                ->requried()
            )
            ->flex(
                VSelect::make()
                    ->field('menu_type')
                    ->label('类型')
                    ->items([
                        ['id'=>'slug', 'name'=>'Slug'], 
                        ['id'=>'url', 'name'=>'URL']
                    ])
                    ->requried()
            )
            ->flex(
            VTextField::make()
                ->field('menu_value')
                ->label('值')
                ->requried()
            )
            ->flex(
                VTextField::make()
                    ->field('columns')
                    ->label('列数')
                    ->integer()
            );
    }


}