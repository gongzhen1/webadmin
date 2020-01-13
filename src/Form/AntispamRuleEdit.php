<?php
namespace Water\Vular\Webadmin\Form;

use Water\Vular\Admin\Templates\SimpleFormPage;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vuetify\VTextArea;

class AntispamRuleEdit extends SimpleFormPage{
    protected $modelClass = \Water\Vular\Webadmin\Models\Antispam::class;
    protected $newTitle = '新建拦截规则';
    protected $editTitle = '编辑拦截规则';

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('网站管理')
                    ->textItem('询盘管理')
                    ->textItem('拦截设置');
    }

    function fields(){
        return [
            VTextField::make()
                ->field('form_field')
                ->label('字段')
                ->hint('可选值：name, email, company, message。 为空表示过滤所有字段'),
            VTextField::make()
                ->field('keyword')
                ->label('关键词'),
            VTextArea::make()
                ->field('markup')
                ->label('备注')
        ];
    }

}