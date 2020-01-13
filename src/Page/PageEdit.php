<?php
namespace Water\Vular\Webadmin\Page;

use Water\Vular\Admin\Templates\OneColumnFormPage;
use Water\Vular\Elements\Vuetify\VLayout;
use Water\Vular\Elements\Vuetify\VFlex;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vuetify\VTextArea;
use Water\Vular\Elements\Vular\VularFormGridCard;
use Water\Vular\Elements\Vular\VularFormCard;
use Water\Vular\Elements\Vular\VularAvatar;
use Water\Vular\Elements\Vuetify\VCard;
use Water\Vular\Elements\Vuetify\VCardText;
use Water\Vular\Elements\Vuetify\VBtn;
use Water\Vular\Elements\Vuetify\VIcon;
use Water\Vular\Elements\Vuetify\VList;
use Water\Vular\Elements\Vuetify\VListTile;
use Water\Vular\Elements\Vuetify\VListTileAction;
use Water\Vular\Elements\Vuetify\VListTileContent;
use Water\Vular\Elements\Vuetify\VListTileTitle;
use Water\Vular\Elements\Vuetify\VMenu;
use Water\Vular\Elements\Vuetify\VSelect;
use Water\Vular\Elements\VularAction;
use Water\Vular\Elements\Vular\VularSlug;
use Water\Vular\Elements\Vular\VularCodeEditor;
use Water\Vular\Webadmin\Base\OgEdit;
use Water\Vular\Webadmin\Base\SeoEdit;
use Water\Vular\Webadmin\Models\PageAttribute;
use Water\Vular\Webadmin\Models\PageCategory;

class PageEdit extends OneColumnFormPage{
    protected $modelClass = \Water\Vular\Webadmin\Models\Page::class;
    protected $newTitle = '新建页面';
    protected $editTitle = '编辑页面';

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('网站管理')
                    ->textItem('网站外观')
                    ->textItem('页面');
        $this->topButton($this->additionButtons());
        $this->bottomButton($this->additionButtons());
    }

    function cards(){
        return[
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
                    VTextField::make()
                        ->field('short_title')
                        ->label('短标题')
                        ->prependInnerIcon('short_text')
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
                    VTextArea::make()
                    ->field('summary')
                    ->label('摘要')
                    ->prependInnerIcon('insert_comment')
                    ->maxLength(500)
                )
                ->flex(
                    VularAvatar::make()
                        ->field('featureImage')
                        ->addSize(page_media_size())
                        ->addSize(page_media_thumb_size())
                        ->label('特色图片')
                )
                ->flex(
                    VTextField::make()
                        ->field('order')
                        ->label('顺序')
                        ->prependInnerIcon('sort')
                        ->float()
                )
                ->flex(
                    VSelect::make()
                        ->field('pageCategory')
                        ->label('分类')
                        ->prependInnerIcon('category')
                        ->items(PageCategory::all())
                )
                ->flex(
                    VSelect::make()
                        ->field('attributes')
                        ->label('附加属性')
                        ->prependInnerIcon('playlist_add')
                        ->items(PageAttribute::all())
                        ->multiple()
                )
                ,
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

                    
                ),

            VularFormGridCard::make()
                ->cardTextClass('pa-0')
                ->title('页面内容')
                ->flex(
                    VularCodeEditor::make()
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
        //if(!request('id')){
        //    $dbModel->user_id = user()->id;
        //}
        $dbModel->status = '1-not-publish';
    }


}