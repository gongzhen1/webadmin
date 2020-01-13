<?php
namespace Water\Vular\Webadmin\Product;

use Water\Vular\Admin\Templates\TwoColumnsFormPage;
use Water\Vular\Elements\Vuetify\VLayout;
use Water\Vular\Elements\Vuetify\VFlex;
use Water\Vular\Elements\Vuetify\VCard;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vuetify\VTextArea;
use Water\Vular\Elements\Vuetify\VCombobox;
use Water\Vular\Elements\Vuetify\VSelect;
use Water\Vular\Elements\Vuetify\VSpeedDial;
use Water\Vular\Elements\Vuetify\VBtn;
use Water\Vular\Elements\Vuetify\VIcon;
use Water\Vular\Elements\Vuetify\VList;
use Water\Vular\Elements\Vuetify\VListTile;
use Water\Vular\Elements\Vuetify\VListTileAction;
use Water\Vular\Elements\Vuetify\VListTileContent;
use Water\Vular\Elements\Vuetify\VListTileTitle;
use Water\Vular\Elements\Vuetify\VMenu;
use Water\Vular\Elements\Vular\VularFormGridCard;
use Water\Vular\Elements\Vular\VularFormOneInputCard;
use Water\Vular\Elements\Vular\VularTiptapEditor;
use Water\Vular\Elements\Relations\VularMediaSelect;
use Water\Vular\Elements\Vular\VularTreeSelect;
use Water\Vular\Elements\Vular\VularFormCard;
use Water\Vular\Elements\Vular\VularSlug;
use Water\Vular\Elements\Vular\VularCodeEditor;
use Water\Vular\Elements\VularAction;
use Water\Vular\Elements\VularNode;
use Water\Vular\Models\Admin;
use Water\Vular\Webadmin\Models\Product;
use Water\Vular\Webadmin\Models\ProductAttribute;
use Water\Vular\Webadmin\Models\ProductCategory;
use Water\Vular\Core\VularResponse;
use Water\Vular\Webadmin\Base\OgEdit;
use Water\Vular\Webadmin\Base\SeoEdit;

class ProductEdit extends TwoColumnsFormPage{
    protected $modelClass = Product::class;
    protected $newTitle = '新建产品';
    protected $editTitle = '编辑产品';

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('网站管理')
                    ->textItem('产品管理')
                    ->textItem('全部产品');
        $this->secondColumn()
            ->class('pl-4');
        $this->topButton($this->additionButtons());
        $this->bottomButton($this->additionButtons());
    }

    function firstColumnCards(){
        return [
            VularFormGridCard::make()
                ->title('基本信息')
               ->flex(
                    VTextField::make()
                        ->field('name')
                        ->label('名称')
                        ->prependInnerIcon('title')
                        ->requried()
                )
                ->flex(
                    VularSlug::make()
                        ->field('slug')
                        ->label('Slug')
                        ->prependInnerIcon('public')
                        ->maxLength(100)
                        ->requried()
                        ->unique()
                )
       /*kingnodchem          ->flex(
                    VTextField::make()
                        ->field('cas_no')
                        ->label('CAS NO')
                        ->maxLength(60),
                        'xs6'
                    )
                ->flex(
                    VTextField::make()
                        ->field('hscode')
                        ->label('HSCODE')
                        ->maxLength(60),
                        'xs6'
                    )
                ->flex(
                    VTextField::make()
                        ->field('purity')
                        ->label('纯度')
                        ->maxLength(60),
                        'xs6'
                    )
                ->flex(
                    VTextField::make()
                        ->field('grade')
                        ->label('级别')
                        ->maxLength(60),
                        'xs6'
                    )
                ->flex(
                    VTextField::make()
                        ->field('specs')
                        ->label('规格')
                        ->maxLength(60),
                        'xs6'
                    )
                ->flex(
                    VTextField::make()
                        ->field('certification')
                        ->label('认证')
                        ->maxLength(60),
                        'xs6'
                    )
                ->flex(
                    VTextField::make()
                        ->field('standard')
                        ->label('标准')
                        ->maxLength(60),
                        'xs6'
                    )
                ->flex(
                    VTextField::make()
                        ->field('packaging')
                        ->label('包装')
                        ->maxLength(60),
                        'xs6'
                    )
                ->flex(
                    VTextField::make()
                        ->field('capacity')
                        ->label('产能')
                        ->maxLength(60),
                        'xs6'
                    )
                ->flex(
                    VTextField::make()
                        ->field('min_order')
                        ->label('最小订单')
                        ->maxLength(60),
                        'xs6'
                    )
                ->flex(
                    VTextField::make()
                        ->field('delivery')
                        ->label('发货时间')
                        ->maxLength(60),
                        'xs6'
                    )
                ->flex(
                    VTextArea::make()
                        ->field('feature')
                        ->label('Feature')
                        ->prependInnerIcon('toys')
                        ->maxLength(500)
                )*/
                ->flex(
                    VTextArea::make()
                        ->field('summary')
                        ->label('简介')
                        ->prependInnerIcon('insert_comment')
                        ->maxLength(500)
                )
                
                ->flex(//For Warmary
                    VularCodeEditor::make()
                        ->field('fast_view_des')
                        //->label('简介')
                        //->prependInnerIcon('insert_comment')
                        //->maxLength(2000)
                )
                ,

            VularFormGridCard::make()
                ->cardTextClass('pa-0')
                ->title('产品内容')
                ->flex(
                    VularTiptapEditor::make()
                        ->field('description'),
                        //->label('标题')
                        //->requried(),
                    'xs12'
                )

                ,

            VularFormGridCard::make()
                ->cardTextClass('pa-0')
                ->title('产品附加信息')
                ->flex(
                    VularTiptapEditor::make()
                        ->field('additional_information'),
                        //->label('标题')
                        //->requried(),
                    'xs12'
                )

        ];
    }

    function additionButtons(){
        return VMenu::make()
            ->offsetY()
            ->origin('center center')
            ->nudgeBottom('10')
            ->transition('scale-transition')
            ->children(
                VBtn::make()
                    ->fab()
                    ->small()
                    ->slot("activator")
                    ->children(
                        VIcon::make('more_horiz')
                    ),
                VList::make()
                     ->class('pa-0')
                     ->children(
                        VListTile::make()
                            ->ripple(true)
                            ->rel('noopener')
                            ->children(
                                VListTileAction::make()
                                    ->children(
                                        VIcon::make('publish')
                                    ),
                                VListTileContent::make()
                                    ->children(
                                        VListTileTitle::make('发布')
                                    )
                            )
                            ->click(
                                VularAction::make()
                                    ->action('publish')
                            ),
                        VListTile::make()
                            ->ripple(true)
                            ->rel('noopener')
                            ->children(
                                VListTileAction::make()
                                    ->children(
                                        VIcon::make('file_copy')
                                    ),
                                VListTileContent::make()
                                    ->children(
                                        VListTileTitle::make('复制')
                                    )
                            )
                            ->click(
                                VularAction::make()
                                    ->action('duplicate')
                            ),
                        VListTile::make()
                            ->ripple(true)
                            ->rel('noopener')
                            ->children(
                                VListTileAction::make()
                                    ->children(
                                        VIcon::make('delete_forever')
                                    ),
                                VListTileContent::make()
                                    ->children(
                                        VListTileTitle::make('删除')
                                    )
                            )
                            ->click(
                                VularAction::make()
                                    ->confirm('删除将不可恢复，确定要删除吗？')
                                    ->action('remove')
                            )
                            ->hidden(!request('id'))
                     )
            );
    }

    function secondColumnCards(){
        return [
            VularFormGridCard::make()
                ->title('显示')
                ->flex(
                    VTextField::make()
                        ->field('order')
                        ->label('顺序')
                        ->prependInnerIcon('sort')
                        //->float()
                )
                ->flex(
                    VTextField::make()
                        ->field('view_times')
                        ->label('浏览次数')
                        ->prependInnerIcon('visibility')
                        ->float()
                )
                ->flex(
                    VSelect::make()
                        ->field('attributes')
                        ->label('附加属性')
                        ->items(ProductAttribute::all())
                        ->multiple()
                ),
            VularFormGridCard::make()
                ->title('产品分类')
                ->flex(
                    VularTreeSelect::make()
                        ->field('categories')
                        //->label('分类选择')
                        ->flat()
                        ->tile()
                        ->activatable()
                        ->selectable()
                        ->hoverable()
                        ->openOnClick()
                        ->leafIcon('folder_special')
                        ->items((new ProductCategory)->buildTree())
                        ->itemKey('id')
                        ->style('border','solid #eee 1px')
                        //->style('border-bottom','solid #bbb 1px')
                ),
            VularFormOneInputCard::make()
                ->flat()
                ->input(
                    VularMediaSelect::make()
                        ->field('medias')
                        ->imageFlexClass('xs6')
                        ->addSize(config('vular.product-media-size'))
                        ->addSize(config('vular.product-media-thumb-size'))
                        ->addSize(config('vular.product-media-small-thumb-size'))
                ),
            VularFormGridCard::make()
                ->title('相关产品')
                ->flex(
                    VSelect::make()
                        ->field('relatedProducts')
                        ->label('相关产品')
                        ->items(Product::all())
                        //->belongsToMany()
                        ->multiple()
                        //->style('border-bottom','solid #bbb 1px')
                ),
            VularFormCard::make()
                ->title('其它信息')
                ->content(
                    VLayout::make()
                        ->column()
                        ->children(
                            VFlex::make()
                                ->class('xs12')
                                ->children(
                                    SeoEdit::make()
                                    ->field('seoMeta')
                                    ->build()
                                ),
                            VFlex::make()
                                ->class('xs12')
                                ->children(
                                    OgEdit::make()
                                    ->field('ogMeta')
                                    ->build()
                                )
                        )

                    
                )
                //->title('附加信息')
        ];
    }


    function publish($viewModel){
        return $this->doSave($viewModel, function($dbModel){
                $dbModel->status = '2-published';
            })
            ->success()
            ->closePage();
    }

    function duplicate($viewModel){
        $targetViewModel = $this->duplicateViewModel($viewModel);
        $slugField = 'slug.name';
        //$targetViewModel->id = null;
        //$targetViewModel->slug = new \stdClass;
        $targetViewModel->$slugField = '';
        $targetViewModel->title = $targetViewModel->title .' 副本';
        return VularResponse::make($targetViewModel);
    }

    function remove($viewModel){
        $modelClass = $this->modelClass;
        $modelClass::destroy($viewModel->id);
        return VularResponse::make()
            ->success()
            ->closePage();
    }

    function beforeSave($dbModel){
        if(!request('id')){
            $dbModel->user_id = user()->id;
        }
        $dbModel->status = '1-not-publish';
    }

}