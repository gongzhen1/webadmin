<?php
namespace Water\Vular\Webadmin\Page;

use Water\Vular\Admin\Page ;
use Water\Vular\Elements\Vuetify\VLayout;
use Water\Vular\Elements\Vuetify\VCard;
use Water\Vular\Elements\Vuetify\VCardText;
use Water\Vular\Elements\Vuetify\VFlex;
use Water\Vular\Elements\Vuetify\VTextField;
use Water\Vular\Elements\Vuetify\VTextArea;
use Water\Vular\Elements\Vuetify\VToolbar;
use Water\Vular\Elements\Vuetify\VToolbarTitle;
use Water\Vular\Elements\Vuetify\VDivider;
use Water\Vular\Elements\Vuetify\VSpacer;
use Water\Vular\Elements\Vuetify\VBtn;
use Water\Vular\Elements\Vuetify\VIcon;
use Water\Vular\Elements\Vuetify\VSelect;
use Water\Vular\Elements\Vular\VularTreeEditor;
use Water\Vular\Core\VularResponse;
use Water\Vular\Elements\Vular\VularForm;
use Water\Vular\Elements\VularAction;
use Water\Vular\Elements\VularEvent;

class SubMenuEdit extends Page{
    protected $editor;
    protected $titleInput;
    protected $modelClass = \Water\Vular\Webadmin\Models\SubMenuItem::class;

    function register(){
        parent::register();
        $this->breadcrumbs->textItem('网站管理')
                    ->textItem('网站外观')
                    ->textItem('子菜单编辑');
        $this->form = VularForm::make()
            ->bindsToPage($this);
        $this->editor = VularTreeEditor::make()
                      ->bindsTo($this->form)
                      ->label('菜单项')
                      ->field('tree');
        $this->titleInput = VTextField::make()
                                ->bindsTo($this->form)
                                ->field('title')
                                ->label('标题')
                                ->prependInnerIcon('title')
                                ->requried();
        $this->editor
            ->itemText('title')
            ->flex(
                VTextField::make()
                    ->field('title')
                    ->label('标题')
                    ->maxLength(30)
                    ->requried()
            )
            ->flex(
                VSelect::make()
                    ->field('menu_type')
                    ->label('类型')
                    ->items([
                        ['id'=>'slug', 'name'=>'Slug'], 
                        ['id'=>'url', 'name'=>'URL']
                    ])
                    ->requried()
            )
            ->flex(
            VTextField::make()
                ->field('menu_value')
                ->label('值')
                ->requried()
            );
    }

    function makeUI(){
        $id=request('id');
        $dbModel = $this->dbModel($id);
        $this->titleInput->defaultValue($dbModel->title);
        $this->editor->defaultValue($dbModel->children );//****重点记住缺省值**//
        $this->form->viewModel(['id'=>$id, 'title'=>$dbModel->title,'tree'=>$dbModel->children ]);

        $this->form
            ->children(
                VLayout::make()
                ->row()
                ->wrap()
                ->children(
                        VFlex::make()
                            ->class('xs12')
                            ->children(
                                VCard::make()                                    
                                    ->children(
                                        VToolbar::make()
                                            //->dark()
                                            //->color('transparent')
                                            ->flat()
                                            ->card()
                                            ->children(
                                                VToolbarTitle::make('菜单信息'),
                                                VSpacer::make(),
                                                VBtn::make(trans('vular.return'))
                                                    ->round()
                                                    ->click(
                                                        VularEvent::make('closePage')
                                                    ),
                                                VBtn::make(trans('vular.save'))
                                                    ->large()
                                                    ->round()
                                                    ->light()
                                                    ->valid()
                                                    ->color('primary')
                                                    ->click(
                                                        VularAction::make()
                                                            ->action('save')
                                                            ->post()
                                                            ->bindsTo($this->form)
                                                    )
                                            ),
                                        VDivider::make()
                                    )
                                    ->children(
                                        VCardText::make()
                                                 ->children(
                                                    $this->titleInput
                                                 )
                                    )
                                )
                        ),
                        VFlex::make()
                            ->class('xs12')
                            ->children(
                                VCard::make()
                                    ->children(
                                        VToolbar::make()
                                            //->dark()
                                            //->color('transparent')
                                            ->flat()
                                            ->card()
                                            ->children(
                                                VToolbarTitle::make('菜单项')
                                            ),
                                        VDivider::make()
                                    )
                                    ->children(
                                      $this->editor
                                    )
                        )
                );
        //);

        $this->children(
                $this->breadcrumbs,
                $this->form
            );

    }

    function modelClass(){
        return $this->modelClass;
    }

    function dbModel($id){
        $modelName = $this->modelClass;
        $dbModel = new $modelName;
        if($id){
            $dbModel = $modelName::find($id);
            $dbModel->bulidChildren();
        }

        return $dbModel;
    }

    function save($viewModel){
        $itemKey = $this->editor->getItemKey();
        $modelName = $this->modelClass;
        $dbModel = new $modelName();
        if($viewModel->id){
            $dbModel=$modelName::find($viewModel->id);
        }
        $dbModel->title = $viewModel->title;
        $dbModel->save();
        $dbModel->bulidChildren();
        $oldIds = $dbModel->childrenIds();

        $modelName::whereIn($itemKey, $oldIds)->delete();
        
        $itemOrder = $this->editor->getItemOrder();
        $ids = [];
        //\Log::notice(json_encode($viewModel));
        foreach ($viewModel->tree as $i => $node) {
            $node->$itemOrder = $i;
            $this->saveNode($node, $dbModel->$itemKey);
        }
        
        return VularResponse::make(['id'=>$viewModel->id,'title'=>$viewModel->title,'tree'=> $dbModel->bulidChildren()])
            ->success();
    }

    function saveNode($viewNode, $parentId){
        $itemKey = $this->editor->getItemKey();
        $itemOrder = $this->editor->getItemOrder();
        if(strpos($viewNode->$itemKey, 'temp-') === 0){
            $viewNode->$itemKey = null;
        }
        $modelName = $this->modelClass;
        $parentKey = $this->editor->getParentKey();
        $dbNode = new $modelName;
        $dbNode->$parentKey = $parentId;
        $dbNode->$itemKey = $viewNode->$itemKey;
        $dbNode->$itemOrder = $viewNode->$itemOrder;
        $this->convertToDb($viewNode, $dbNode);
        $dbNode->save();
        //array_push($ids, $dbNode->$itemKey);
        if(property_exists($viewNode, 'children')){
            foreach ($viewNode->children as $i => $node) {
                $node->$itemOrder = $i;
                $this->saveNode($node, /*$ids,*/ $dbNode->$itemKey);
            }
        }
    }

    function convertToDb($viewNode, $dbNode){
        foreach ($this->editor->flexs() as $flex) {
            $fieldName = $flex->field->field;
            if(property_exists($viewNode, $fieldName)){
                $dbNode->$fieldName = $viewNode->$fieldName;
            }
        }
    }


}