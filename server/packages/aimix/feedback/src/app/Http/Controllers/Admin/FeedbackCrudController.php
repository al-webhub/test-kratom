<?php

namespace Aimix\Feedback\app\Http\Controllers\Admin;
//namespace App\Http\Controllers\Admin;

use Aimix\Feedback\app\Http\Requests\FeedbackRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Hash;

use Aimix\Feedback\app\Models\Feedback;
use App\User;

/**
 * Class FeedbackCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class FeedbackCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('Aimix\Feedback\app\Models\Feedback');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/feedback');
        $this->crud->setEntityNameStrings('feedback', 'feedback');
        
        $this->types = array_unique(Feedback::pluck('type', 'type')->toArray());
    }
    
    protected function setupShowOperation(){ 
      
        $this->crud->set('show.setFromDb', false);
        
        $this->crud->addColumn([
                'name' => 'name',
                'label' => 'Имя',
            ]);
        $this->crud->addColumn([
                'name' => 'phone',
                'label' => 'Телефон',
            ]);
            
        $this->crud->addColumn([
                'name' => 'email',
                'label' => 'Email',
                'type' => 'text'
            ]);
        $this->crud->addColumn([
                'name' => 'theme',
                'label' => 'Тема',
            ]);
        $this->crud->addColumn([
                'name' => 'files',
                'label' => 'Файлы',
                'type' => 'upload_multiple'
            ]);
        $this->crud->addColumn([
                'name' => 'message',
                'label' => 'Сообщение',
                'type' => 'textarea',
                'options' => [
                  'rows' => '7'
              ]
            ]);
    }
    
    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        // $this->crud->setFromDb();
        $this->crud->addFilter([
          'name' => 'type',
          'label' => 'Тип',
          'type' => 'select2'
        ], function(){
          return $this->types;
        }, function($value){
          $this->crud->addClause('where', 'type', $value);
        });
        
      
        $this->crud->addColumn([
                'name' => 'name',
                'label' => __('feedback::feedback.name'),
            ]);

        $this->crud->addColumn([
                'name' => 'phone',
                'label' => __('feedback::feedback.phone'),
            ]);

        $this->crud->addColumn([
                'name' => 'email',
                'label' => __('feedback::feedback.email'),
            ]);

        $this->crud->addColumn([
                'name' => 'type',
                'label' => __('feedback::feedback.type'),
            ]);
            
    }

    // protected function setupCreateOperation()
    // {
    //     $this->crud->setValidation(FeedbackRequest::class);

    //     TODO: remove setFromDb() and manually define Fields
    //      $this->crud->setFromDb();
        
        
    // }

    protected function setupUpdateOperation()
    {
        // $this->setupCreateOperation();
        $this->crud->addFields([
          [
            'name' => 'name',
            'label' => 'Имя',
            'type' => 'text'
          ],
          [
            'name' => 'phone',
            'label' => 'Телефон',
            'type' => 'text'
          ],
          [
            'name' => 'text',
            'label' => 'Сообщение',
            'type' => 'textarea',
            'attributes' => [
              'rows' => '7'
            ]
          ],
        ]);
    }
    
    public function create(FeedbackRequest $request) 
    {
      $type = $request->type;
      $feedback = new Feedback;
      $feedback->type = $type;
      $feedback->name = $request->input($type . '_name');
      $feedback->phone = $request->input($type . '_phone');
      $feedback->email = $request->input($type . '_email');
      // $feedback->theme = $request->input('theme');
      $feedback->text = $request->input($type . '_text');
      $feedback->files = $request->input($type . '_file');
      
      $feedback->save();
      
      return back()->with('message', 'Заявка успешно отправлена')->with('type', 'success');
    }
    
}
