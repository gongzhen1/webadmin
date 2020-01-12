<?php
namespace Water\Vular\Post\Pages;

use Water\Vular\Admin\Templates\DataTablePage;
use Water\Vular\Elements\Vular\VularTableColumn;
use Water\Vular\Elements\VularNode;
use Water\Vular\Elements\Vuetify\VChip;
use Water\Vular\Elements\Vuetify\VBtn;
use Water\Vular\Elements\Vuetify\VIcon;
use Water\Vular\Elements\VularAction;
use Water\Vular\Core\VularResponse;

class PostList extends DataTablePage{
    protected $title = '文章列表';
    
    function register(){
        parent::register();
        $this->breadcrumbs->textItem('网站管理')
                    ->textItem('文章管理')
                    ->textItem('全部文章');
    }

    function editPage(){
        return PostEdit::make();
    }

    function columns(){
        
        return [ 
            VularTableColumn::make('title','标题')
                ->searchable()
                ->sortable(),
            VularTableColumn::make('status','状态'),
            VularTableColumn::make('created_at','时间')
        ];

    }

    function onRow($row){
        parent::onRow($row);
        $normalChip = VularNode::make()//VularNode的属性会被赋予单元格
            ->children(VChip::make('已发布')
                ->textColor('white')
                ->small()
            );
        $notPublishChip = VularNode::make()
            ->children(VChip::make('未发布')
                ->color('red')
                ->textColor('white')
                ->small()
            );
        $row->status = $row->status =='1-not-publish' ? $notPublishChip  : $normalChip;
    }
   

    function rowActionButtons($buttonArray, $row){

        if($row->status =='1-not-publish'){
            $publishButton = VBtn::make()
                ->class('ma-0')
                ->style('width:26px;height:26px;')
                ->flat()
                ->icon()
                ->small()
                ->color('#757575')
                ->children(
                    VIcon::make('publish')
                        ->small()
                )
                ->click(
                    VularAction::make('publish')
                    ->bindsTo($this->vularDataTable)
                    ->param('id', $row->id)
                );
            array_unshift($buttonArray, $publishButton);

        }
        return $buttonArray;
    }

    function appendToQuery($queryBuilder){
        $queryBuilder->orderBy('created_at','desc');
        $user = user();
        if($user->isPermitted('posts_all_data')){
            return $queryBuilder;
        }
        return $queryBuilder->where('posts.user_id', $user->id);

    }

    function publish($viewModel){
        $modelClass = $this->modelClass();
        $post = $modelClass::find($viewModel->params->id);
        $post->status = '2-published';
        $post->save();
        return $this->fetch($viewModel); 
    }


    function batchPublish($viewModel){
        $modelClass = $this->modelClass();
        $modelClass::whereIn('id',$viewModel->selected)
            ->update(['status'=>'2-published']);
        return $this->fetch($viewModel); 
    }


}