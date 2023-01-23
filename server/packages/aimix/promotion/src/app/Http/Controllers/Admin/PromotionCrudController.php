<?php

namespace Aimix\Promotion\app\Http\Controllers\Admin;

use Aimix\Promotion\app\Http\Requests\PromotionRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use Backpack\LangFileManager\app\Models\Language;

/**
 * Class PromotionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class PromotionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    
    private $languages = 'ru';

    public function setup()
    {
        $this->crud->setModel('Aimix\Promotion\app\Models\Promotion');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/promotion');
        $this->crud->setEntityNameStrings('акция', 'акции');
        
        if(config('aimix.aimix.enable_languages')) {
          $this->languages = Language::getActiveLanguagesNames();
          
          $this->crud->query = $this->crud->query->withoutGlobalScopes();
          $this->crud->model->clearGlobalScopes();
        }
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
        
        if(config('aimix.aimix.enable_languages')) {
          $this->crud->addFilter([
            'name'  => 'language',
            'type'  => 'select2',
            'label' => 'Язык'
          ], function () {
            return $this->languages;
          }, function ($value) { // if the filter is active
            $this->crud->addClause('where', 'language_abbr', $value);
          });
          
          $this->crud->addColumn([
            'name' => 'language_abbr',
            'label' => 'Язык',
          ]);
        }
        
        $this->crud->addColumns([
          [
            'name' => 'title',
            'label' => 'Заголовок',
          ],
          [
            'name' => 'image',
            'label' => 'Изображение',
            'type' => 'image',
          ],
          [
            'name' => 'desc',
            'label' => 'Описание',
          ]
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(PromotionRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        // $this->crud->setFromDb();
      if(config('aimix.aimix.enable_languages')) {
        $this->crud->addField([
          'name' => 'language_abbr',
          'label' => 'Язык',
          'type' => 'select_from_array',
          'options' => $this->languages
        ]);
      }
        
        $this->crud->addFields([
          [
            'name' => 'title',
            'label' => 'Заголовок',
          ],
          [
            'name' => 'slug',
            'label' => 'URL',
            'prefix' => url('/promotions').'/',
            'hint' => 'По умолчанию будет сгенерирован из заголовка.'
          ],
          [
            'name' => 'image',
            'label' => 'Изображение',
            'type' => 'browse',
          ],
          [
            'name' => 'desc',
            'label' => 'Описание',
            'type' => 'ckeditor',
            'attributes' => [
              'rows' => 7,
            ]
          ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
