<?php
namespace Water\Vular\Webadmin\Page;

use Water\Vular\Admin\Templates\DataTablePage;
use Water\Vular\Elements\Vular\VularTableColumn;

class PageList extends DataTablePage{
    protected $title = '页面列表';
    
    function editPage(){
        return PageEdit::make();
    }

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('网站管理')
                    ->textItem('网站外观')
                    ->textItem('页面');
    }

    function columns(){
        
        return [ 
            VularTableColumn::make('title','标题')
                ->searchable(),
            VularTableColumn::make('created_at','时间')
                ->sortable()
        ];

    }


}