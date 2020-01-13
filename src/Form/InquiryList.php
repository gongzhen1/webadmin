<?php
namespace Water\Vular\Webadmin\Form;

use Water\Vular\Admin\Templates\DataTablePage;
use Water\Vular\Elements\Html\Span;
use Water\Vular\Elements\Vular\VularTableColumn;
use Water\Vular\Elements\Vuetify\VChip;
use Water\Vular\Elements\Vuetify\VBtn;
use Water\Vular\Elements\Vuetify\VIcon;
use Water\Vular\Elements\VularAction;
use Water\Vular\Core\VularResponse;
use Water\Vular\Webadmin\Models\Inquiry;

class InquiryList extends DataTablePage{
    protected $title = '询盘列表';
    
    ///function editPage(){
    //    return MenuEdit::make();
    //}

    function register(){
        parent::register();
        $this->setModelClass(Inquiry::class);
        $this->breadcrumbs->textItem('网站管理')
                    ->textItem('询盘管理')
                    ->textItem('询盘列表');
    }

    function columns(){
        
        return [ 
            VularTableColumn::make('company','公司')
                ->searchable()
                ->sortable(),
            VularTableColumn::make('name','姓名')
                ->searchable()
                ->sortable(),
            VularTableColumn::make('email','邮箱')
                ->searchable()
                ->sortable(),
            VularTableColumn::make('created_at','时间')
                ->sortable()
        ];

    }

    function appendToQuery($queryBuilder){
        return $queryBuilder->where('is_spam', false)->orderBy('is_new','desc')->orderBy('created_at','desc');
    }

    function rowActionButtons($buttonArray, $row){

        $viewButton = VBtn::make()
            ->class('ma-0')
            ->style('width:26px;height:26px;')
            ->flat()
            ->icon()
            ->small()
            ->color('#757575')
            ->children(
                VIcon::make('pageview')
                    ->small()
            )
            ->click(
                (new InquiryView)->toMeAction()
                    ->param('id', $row->id)
            );
        array_unshift($buttonArray, $viewButton);

        return $buttonArray;
    }

    function rowEditButton($btn, $row){
        return null;
    }

    function onRow($row){
        parent::onRow($row);
        if($row->is_new){
           $row->company = Span::make($row->company)->style('font-weight','bold');
           $row->name = Span::make($row->name)->style('font-weight','bold');
           $row->email = Span::make($row->email)->style('font-weight','bold');
        }
    }

}