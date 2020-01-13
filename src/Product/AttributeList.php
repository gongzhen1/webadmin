<?php
namespace Water\Vular\Webadmin\Product;

use Water\Vular\Admin\Templates\DataTablePage;
use Water\Vular\Elements\Vular\VularTableColumn;

class AttributeList extends DataTablePage{
    protected $title = '属性列表';
    
    function editPage(){
        return AttributeEdit::make();
    }

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('网站管理')
                    ->textItem('产品管理')
                    ->textItem('属性管理');
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