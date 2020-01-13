<?php
namespace Water\Vular\Webadmin\Post;

use Water\Vular\Admin\Templates\DataTablePage;
use Water\Vular\Elements\Vular\VularTableColumn;

class TagList extends DataTablePage{
    protected $title = '标签列表';
    
    function editPage(){
        return TagEdit::make();
    }

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('网站管理')
                    ->textItem('文章管理')
                    ->textItem('标签管理');
    }

    function columns(){
        
        return [ 
            VularTableColumn::make('name','标签')
                ->searchable(),
            VularTableColumn::make('created_at','时间')
                ->sortable()
        ];

    }


}