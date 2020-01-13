<?php
namespace Water\Vular\Webadmin\Form;

use Water\Vular\Admin\Page;
use Water\Vular\Elements\Vuetify\VLayout;
use Water\Vular\Elements\Vuetify\VFlex;
use Water\Vular\Elements\Vuetify\VCard;
use Water\Vular\Elements\Vuetify\VCardText;
use Water\Vular\Elements\Vuetify\VDivider;
use Water\Vular\Elements\Vuetify\VToolbar;
use Water\Vular\Elements\Vuetify\VToolbarTitle;
use Water\Vular\Elements\Vuetify\VForm;
use Water\Vular\Elements\Vuetify\VBtn;
use Water\Vular\Elements\Vuetify\VTextarea;
use Water\Vular\Elements\VularEvent;

class InquiryView extends Page{
    protected $modelClass = \Water\TestPools\Models\Inquiry::class;
    protected $title = '查看询盘';


    function register(){
        parent::register();
        $this->breadcrumbs->textItem('询盘管理')
                    ->textItem('查看询盘');

    }

    function makeUI(){
        $modelClass = $this->modelClass;
        $model = $modelClass::find(request('id'));
        $model->is_new = false;
        $model->save();

        $cancelBtn = VBtn::make(trans('vular.cancel'))
            ->round()
            ->click(
                VularEvent::make('closePage')
            );

        $layout = VLayout::make()
            ->row()
            ->wrap()
            ->children(
                VFlex::make()
                    ->class('md10 sm12')
                    ->children(
                        VCard::make()
                            ->children(
                                VToolbar::make()
                                    //->dark()
                                    //->color('transparent')
                                    ->flat()
                                    ->card()
                                    ->children(
                                        VToolbarTitle::make($this->title)
                                    ),
                                VDivider::make()
                            )
                            ->children(
                                VCardText::make()
                                ->class('pa-4')
                                ->children(
                                    VLayout::make()
                                        ->children(
                                            VFlex::make('Name:')
                                            ->class('pa-3 text-xs-right')
                                            ->xs(2),
                                            VFlex::make($model->name)
                                            ->class('pa-3')
                                            ->xs(10)
                                        ),
                                    VLayout::make()
                                        ->children(
                                            VFlex::make('Email:')
                                            ->class('pa-3 text-xs-right')
                                            ->xs(2),
                                            VFlex::make($model->email)
                                            ->class('pa-3')
                                            ->xs(10)
                                        ),
                                    VLayout::make()
                                        ->children(
                                            VFlex::make('Tel:')
                                            ->class('pa-3 text-xs-right')
                                            ->xs(2),
                                            VFlex::make($model->tel)
                                            ->class('pa-3')
                                            ->xs(10)
                                        ),
                                    VLayout::make()
                                        ->children(
                                            VFlex::make('Message:')
                                            ->class('pa-3 text-xs-right')
                                            ->xs(2),
                                            VFlex::make()
                                            ->class('pa-3')
                                            ->xs(10)
                                            ->children(
                                                VTextarea::make()
                                                    ->defaultValue($model->message)
                                            )
                                        ),
                                    VLayout::make()
                                        ->children(
                                            VFlex::make('URL:')
                                            ->class('pa-3 text-xs-right')
                                            ->xs(2),
                                            VFlex::make($model->url)
                                            ->class('pa-3')
                                            ->xs(10)
                                        ),
                                    VLayout::make()
                                        ->children(
                                            VFlex::make('IP:')
                                            ->class('pa-3 text-xs-right')
                                            ->xs(2),
                                            VFlex::make($model->ip)
                                            ->class('pa-3')
                                            ->xs(10)
                                        ),
                                    VLayout::make()
                                        ->children(
                                            VFlex::make('Browser:')
                                            ->class('pa-3 text-xs-right')
                                            ->xs(2),
                                            VFlex::make($model->browser)
                                            ->class('pa-3')
                                            ->xs(10)
                                        )
                                )
                                ->children(
                                    VDivider::make(),
                                    $cancelBtn
                                )
                            )
                    )
            );

        $this->children(
            $this->breadcrumbs,
            $layout
        );
    }


    function saveBtn(){
        return null;
    }


}