<?php
namespace Water\Vular\Webadmin\Post;

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
use Water\Vular\Elements\Vular\VularSlug;
use Water\Vular\Elements\Relations\VularMediaSelect;
use Water\Vular\Elements\Vular\VularTreeSelect;
use Water\Vular\Elements\Vular\VularFormCard;
use Water\Vular\Elements\VularAction;
use Water\Vular\Elements\VularNode;
use Water\Vular\Models\Admin;
use Water\Vular\Webadmin\Models\PostAttribute;
use Water\Vular\Webadmin\Models\PostCategory;
use Water\Vular\Webadmin\Models\PostTag;
use Water\Vular\Webadmin\Models\Product;
use Water\Vular\Core\VularResponse;
use Water\Vular\Webadmin\Base\OgEdit;
use Water\Vular\Webadmin\Base\SeoEdit;

class PostEdit extends TwoColumnsFormPage{
    protected $modelClass = \Water\Vular\Webadmin\Models\Post::class;
    protected $newTitle = '新建文章';
    protected $editTitle = '编辑文章';

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('网站管理')
                    ->textItem('文章管理')
                    ->textItem('全部文章');
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
                        ->field('title')
                        ->label('标题')
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
                ->flex(
                    VSelect::make()
                        ->field('author')
                        ->label('作者')
                        ->items(Admin::all())
                        ->prependInnerIcon('person')
                )
                ->flex(
                    VTextField::make()
                        ->field('source')
                        ->label('来源')
                        ->prependInnerIcon('file_copy')
                        ->maxLength(50)
                )
                ->flex(
                    VTextField::make()
                        ->field('source_link')
                        ->label('来源网址')
                        ->prependInnerIcon('link')
                        ->maxLength(100)
                )
                ->flex(
                    VTextArea::make()
                        ->field('summary')
                        ->label('简介')
                        ->prependInnerIcon('insert_comment')
                        ->maxLength(500)
                )

                ->flex(
                    VCombobox::make()
                        ->field('tags')
                        ->label('标签')
                        ->chips()
                        ->prependInnerIcon('label')
                        ->items(PostTag::all())
                        ->widthEdit()
                        ->multiple()
                        ->hint('添加多个标签，回车分割')
                )
                ,

            VularFormGridCard::make()
                ->cardTextClass('pa-0')
                ->title('文章内容')
                ->flex(
                    VularTiptapEditor::make()
                        ->field('content'),
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
                        ->float()
                )
                ->flex(
                    VSelect::make()
                        ->field('attributes')
                        ->label('附加属性')
                        ->items(PostAttribute::all())
                        ->multiple()
                ),
            VularFormGridCard::make()
                ->title('文章分类')
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
                        ->items((new PostCategory)->buildTree())
                        ->itemKey('id')
                        ->style('border','solid #eee 1px')
                        //->style('border-bottom','solid #bbb 1px')
                ),
            VularFormOneInputCard::make()
                ->flat()
                ->input(
                    VularMediaSelect::make()
                        ->field('medias')
                        ->addSize(post_media_size())
                        ->addSize(post_media_thumb_size())
                        ->imageFlexClass('xs6')
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
                ->title('附加信息')
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