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
use Water\Vular\Admin\Breadcrumbs;

class SpamList extends InquiryList{
    
    ///function editPage(){
    //    return MenuEdit::make();
    //}

    function register(){
        parent::register();
        $this->title = '垃圾询盘列表';
        $this->setModelClass(Inquiry::class);
        $this->breadcrumbs = Breadcrumbs::make();
        $this->breadcrumbs->textItem('网站管理')
                    ->textItem('询盘管理')
                    ->textItem('垃圾询盘列表');
    }

    function appendToQuery($queryBuilder){
        return $queryBuilder->where('is_spam', true)->orderBy('is_new','desc')->orderBy('created_at','desc');
    }

}