<?php
namespace Water\Vular\Webadmin\Page;

use Water\Vular\Admin\Templates\DataTablePage;
use Water\Vular\Elements\Vular\VularTableColumn;

class SubMenuList extends DataTablePage{
    protected $title = '子菜单列表';
    
    function editPage(){
        return SubMenuEdit::make();
    }

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('网站管理')
                    ->textItem('网站外观')
                    ->textItem('子菜单管理');
    }

    function columns(){
        
        return [ 
            VularTableColumn::make('title','菜单名称')
                ->searchable(),
            VularTableColumn::make('created_at','时间')
                ->sortable()
        ];

    }
    function appendToQuery($queryBuilder){
        $queryBuilder->orderBy('created_at','desc');
        return $queryBuilder->whereNull('sub_menu_items.parent_id');

    }



}