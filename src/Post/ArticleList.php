<?php
namespace Water\Vular\Webadmin\Post;

class ArticleList extends PostList{
    protected $title = '文章列表';
    function register(){
        parent::register();
        $this->breadcrumbs->textItem('网站管理')
                    ->textItem('文章管理')
                    ->textItem('全部文章');
    }
 
    function appendToQuery($queryBuilder){
        $queryBuilder->where('status','2-published')
        	         ->orderBy('created_at','desc');
        $user = user();
        if($user->isPermitted('posts_all_data')){
            return $queryBuilder;
        }
        return $queryBuilder->where('posts.user_id', $user->id);

    }
 
}