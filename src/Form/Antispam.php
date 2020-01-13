<?php
namespace Water\Vular\Webadmin\Form;

use Water\Vular\Admin\Templates\DataTablePage;
use Water\Vular\Elements\Vular\VularTableColumn;

class Antispam extends DataTablePage{
    protected $title = '拦截规则列表';
    
    function editPage(){
        return AntispamRuleEdit::make();
    }

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('网站管理')
                    ->textItem('询盘管理')
                    ->textItem('拦截设置');
    }

    function columns(){
        
        return [ 
            VularTableColumn::make('form_field','字段')
                ->searchable(),
            VularTableColumn::make('keyword','关键词')
                ->searchable(),
            VularTableColumn::make('created_at','时间')
                ->sortable()
        ];

    }


}