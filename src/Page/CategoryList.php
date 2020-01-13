<?php
namespace Water\Vular\Webadmin\Page;

use Water\Vular\Admin\Templates\DataTablePage;
use Water\Vular\Elements\Vular\VularTableColumn;

class CategoryList extends DataTablePage{
    protected $title = '分类列表';
    
    function editPage(){
        return CategoryEdit::make();
    }

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('网站管理')
                    ->textItem('页面管理')
                    ->textItem('分类管理');
    }

    function columns(){
        
        return [ 
            VularTableColumn::make('slug','标识')
                ->searchable(),
            VularTableColumn::make('name','名称')
                ->sortable()
        ];

    }


}