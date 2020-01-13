<?php
namespace Water\Vular\Webadmin\Post;

use Water\Vular\Elements\Vuetify\VBtn;
use Water\Vular\Elements\Vuetify\VIcon;
use Water\Vular\Elements\VularAction;
use Water\Vular\Core\VularResponse;

class DraftList extends PostList{
    protected $title = '草稿列表';
    function register(){
        parent::register();
        $this->breadcrumbs->textItem('网站管理')
                    ->textItem('文章管理')
                    ->textItem('草稿箱');
        $this->batchMenu()
             ->unshiftAction('publish','发布', VularAction::make('batchPublish'));
    }

    function rowActionButtons($buttonArray, $row){
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
        return $buttonArray;
    }


    function appendToQuery($queryBuilder){
        $queryBuilder->where('status','1-not-publish')
        	         ->orderBy('created_at','desc');
        $user = user();
        if($user->isPermitted('posts_all_data')){
            return $queryBuilder;
        }
        return $queryBuilder->where('posts.user_id', $user->id);

    }

    function publish($viewModel){
        $modelClass = $this->modelClass();
        $modelClass::where('id',$viewModel->params->id)
            ->update(['status'=>'2-published']);
        return $this->fetch($viewModel); 
    }


    function batchPublish($viewModel){
        $modelClass = $this->modelClass();
        $modelClass::whereIn('id',$viewModel->selected)
            ->update(['status'=>'2-published']);
        return $this->fetch($viewModel); 
    }
  
}