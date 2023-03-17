<?php

namespace App;

trait PageTemplates
{
    /*
    |--------------------------------------------------------------------------
    | Page Templates for Backpack\PageManager
    |--------------------------------------------------------------------------
    |
    | Each page template has its own method, that define what fields should show up using the Backpack\CRUD API.
    | Use snake_case for naming and PageManager will make sure it looks pretty in the create/update form
    | template dropdown.
    |
    | Any fields defined here will show up after the standard page fields:
    | - select template
    | - page name (only seen by admins)
    | - page title
    | - page slug
    */

    private function advantages()
    {
        $this->crud->addField([   // CustomHTML
            'name' => 'content_separator_0',
            'type' => 'custom_html',
            'value' => '<br><h2>SEO</h2><hr>',
        ]);
                    
        $this->crud->addField([
            'name' => 'meta_title',
            'label' => trans('backpack::pagemanager.meta_title'),
            'fake' => true,
            'store_in' => 'extras',
        ]);
        
        $this->crud->addField([
            'name' => 'meta_description',
            'label' => trans('backpack::pagemanager.meta_description'),
            'fake' => true,
            'store_in' => 'extras',
        ]);
        
        $this->crud->addField([
            'name' => 'h1',
            'label' => 'H1 заголовок',
            'fake' => true,
            'store_in' => 'extras'
        ]);
        
        $this->crud->addField([
            'name' => 'seo_text',
            'label' => 'SEO текст',
            'fake' => true,
            'store_in' => 'extras',
            'type' => 'ckeditor'
        ]);
        
        $this->crud->addField([   // CustomHTML
            'name' => 'content_separator_1',
            'type' => 'custom_html',
            'value' => '<br><h2>Consultation</h2><hr>',
        ]);  
        
        $this->crud->addField([
            'name' => 'consultation_t',
            'label' => 'Consultation title',
            'fake' => true,
            'store_in' => 'extras'
        ]);   
        
        $this->crud->addField([
            'name' => 'consultation_c',
            'label' => 'Consultation content',
            'type' => 'ckeditor',
            'fake' => true,
            'store_in' => 'extras'
        ]);
        
        $this->crud->addField([   // CustomHTML
            'name' => 'content_separator_2',
            'type' => 'custom_html',
            'value' => '<br><h2>Return the money</h2><hr>',
        ]);  
        
        $this->crud->addField([
            'name' => 'money_t',
            'label' => 'Money title',
            'fake' => true,
            'store_in' => 'extras'
        ]);   
        
        $this->crud->addField([
            'name' => 'money_c',
            'label' => 'Money content',
            'type' => 'ckeditor',
            'fake' => true,
            'store_in' => 'extras'
        ]);  
        
        
        $this->crud->addField([   // CustomHTML
            'name' => 'content_separator_3',
            'type' => 'custom_html',
            'value' => '<br><h2>Fast delivery</h2><hr>',
        ]);  
        
        $this->crud->addField([
            'name' => 'delivery_t',
            'label' => 'Delivery title',
            'fake' => true,
            'store_in' => 'extras'
        ]);   
        
        $this->crud->addField([
            'name' => 'delivery_c',
            'label' => 'Delivery content',
            'type' => 'ckeditor',
            'fake' => true,
            'store_in' => 'extras'
        ]); 
        
        $this->crud->addField([   // CustomHTML
            'name' => 'content_separator_4',
            'type' => 'custom_html',
            'value' => '<br><h2>Quality</h2><hr>',
        ]);  
        
        $this->crud->addField([
            'name' => 'quality_t',
            'label' => 'Quality title',
            'fake' => true,
            'store_in' => 'extras'
        ]);   
        
        $this->crud->addField([
            'name' => 'quality_c',
            'label' => 'Quality content',
            'type' => 'ckeditor',
            'fake' => true,
            'store_in' => 'extras'
        ]);   
    }

    private function common()
    {
        $this->crud->addField([
                        'name' => 'content',
                        'label' => trans('backpack::pagemanager.content'),
                        'type' => 'ckeditor',
                        'placeholder' => trans('backpack::pagemanager.content_placeholder'),
                    ]);
                    
        $this->crud->addField([
                        'name' => 'meta_title',
                        'label' => trans('backpack::pagemanager.meta_title'),
                        'fake' => true,
                        'store_in' => 'extras',
                    ]);
        $this->crud->addField([
                        'name' => 'meta_description',
                        'label' => trans('backpack::pagemanager.meta_description'),
                        'fake' => true,
                        'store_in' => 'extras',
                    ]);
        $this->crud->addField([
                        'name' => 'h1',
                        'label' => 'H1 заголовок',
                        'fake' => true,
                        'store_in' => 'extras'
                    ]);
        $this->crud->addField([
                        'name' => 'seo_text',
                        'label' => 'SEO текст',
                        'fake' => true,
                        'store_in' => 'extras',
                        'type' => 'ckeditor'
                    ]);
	}
	
    private function about_us()
    {
        $this->crud->addField([   // CustomHTML
            'name' => 'content_separator_0',
            'type' => 'custom_html',
            'value' => '<br><h2>SEO</h2><hr>',
        ]);
        	    
        $this->crud->addField([
                        'name' => 'meta_title',
                        'label' => trans('backpack::pagemanager.meta_title'),
                        'fake' => true,
                        'store_in' => 'extras',
                    ]);
        $this->crud->addField([
                        'name' => 'meta_description',
                        'label' => trans('backpack::pagemanager.meta_description'),
                        'fake' => true,
                        'store_in' => 'extras',
                    ]);
        $this->crud->addField([
                        'name' => 'h1',
                        'label' => 'H1 заголовок',
                        'fake' => true,
                        'store_in' => 'extras'
                    ]);
        $this->crud->addField([
                        'name' => 'seo_text',
                        'label' => 'SEO текст',
                        'fake' => true,
                        'store_in' => 'extras',
                        'type' => 'ckeditor'
                    ]);
                    	    
        $this->crud->addField([   // CustomHTML
            'name' => 'content_separator_1',
            'type' => 'custom_html',
            'value' => '<br><h2>Первый блок</h2><hr>',
        ]);
        $this->crud->addField([
            'name' => 'image_1',
            'type' => 'browse',
            'label' => 'Изображение',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        $this->crud->addField([
            'name' => 'title_1',
            'label' => 'Заголовок',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        $this->crud->addField([
            'name' => 'content_1',
            'label' => 'Текст',
            'type' => 'textarea',
            'placeholder' => 'Текст',
            'fake' => true,
            'store_in' => 'extras',
            'attributes' => [
                'rows' => 8
            ]
        ]);
        $this->crud->addField([
            'name' => 'q_1',
            'label' => 'Цитата',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        
        $this->crud->addField([   // CustomHTML
            'name' => 'content_separator_2',
            'type' => 'custom_html',
            'value' => '<br><h2>Второй блок</h2><hr>',
        ]);
        $this->crud->addField([
            'name' => 'image_2',
            'type' => 'browse',
            'label' => 'Изображение',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        $this->crud->addField([
            'name' => 'title_2',
            'label' => 'Заголовок',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        $this->crud->addField([
            'name' => 'content_2',
            'label' => 'Текст',
            'type' => 'textarea',
            'placeholder' => 'Текст',
            'fake' => true,
            'store_in' => 'extras',
            'attributes' => [
                'rows' => 8
            ]
        ]);
        $this->crud->addField([   // CustomHTML
            'name' => 'content_separator_3',
            'type' => 'custom_html',
            'value' => '<br><h2>Третий блок</h2><hr>',
        ]);
        $this->crud->addField([
            'name' => 'image_3',
            'type' => 'browse',
            'label' => 'Изображение',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        $this->crud->addField([
            'name' => 'content_3',
            'label' => 'Текст',
            'type' => 'textarea',
            'placeholder' => 'Текст',
            'fake' => true,
            'store_in' => 'extras',
            'attributes' => [
                'rows' => 8
            ]
        ]);
    }
    private function payment_and_delivery()
    {
	    $this->crud->addField([   // CustomHTML
            'name' => 'content_separator_0',
            'type' => 'custom_html',
            'value' => '<br><h2>SEO</h2><hr>',
        ]);
        	    
        $this->crud->addField([
                        'name' => 'meta_title',
                        'label' => trans('backpack::pagemanager.meta_title'),
                        'fake' => true,
                        'store_in' => 'extras',
                    ]);
        $this->crud->addField([
                        'name' => 'meta_description',
                        'label' => trans('backpack::pagemanager.meta_description'),
                        'fake' => true,
                        'store_in' => 'extras',
                    ]);
        $this->crud->addField([
                        'name' => 'h1',
                        'label' => 'H1 заголовок',
                        'fake' => true,
                        'store_in' => 'extras'
                    ]);
        $this->crud->addField([
                        'name' => 'seo_text',
                        'label' => 'SEO текст',
                        'fake' => true,
                        'store_in' => 'extras',
                        'type' => 'ckeditor'
                    ]);
                    
        $this->crud->addField([   // CustomHTML
            'name' => 'content_separator_1',
            'type' => 'custom_html',
            'value' => '<br><h2>Payment</h2><hr>',
        ]);
        $this->crud->addField([
            'name' => 'payment_info_title',
            'label' => 'Payment info title',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        $this->crud->addField([
            'name' => 'payment_info',
            'label' => 'Payment info',
            'type' => 'wysiwyg',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        
        $this->crud->addField([   // CustomHTML
            'name' => 'content_separator_2',
            'type' => 'custom_html',
            'value' => '<br><h2>Delivery times</h2><hr>',
        ]);
        $this->crud->addField([
            'name' => 'delivery_times_title',
            'label' => 'Delivery times title',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        $this->crud->addField([
            'name' => 'delivery_times',
            'label' => 'Delivery times',
            'type' => 'wysiwyg',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        
        $this->crud->addField([   // CustomHTML
            'name' => 'content_separator_3',
            'type' => 'custom_html',
            'value' => '<br><h2>Delivery methods</h2><hr>',
        ]);
        $this->crud->addField([
            'name' => 'delivery_method_title',
            'label' => 'Delivery methods title',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        $this->crud->addField([
            'name' => 'delivery_method',
            'label' => 'Delivery methods',
            'type' => 'wysiwyg',
            'fake' => true,
            'store_in' => 'extras',
        ]);
    }
    private function rewards()
    {
	    $this->crud->addField([   // CustomHTML
            'name' => 'content_separator_0',
            'type' => 'custom_html',
            'value' => '<br><h2>SEO</h2><hr>',
        ]);
        	    
        $this->crud->addField([
                        'name' => 'meta_title',
                        'label' => trans('backpack::pagemanager.meta_title'),
                        'fake' => true,
                        'store_in' => 'extras',
                    ]);
        $this->crud->addField([
                        'name' => 'meta_description',
                        'label' => trans('backpack::pagemanager.meta_description'),
                        'fake' => true,
                        'store_in' => 'extras',
                    ]);
        $this->crud->addField([
                        'name' => 'h1',
                        'label' => 'H1 заголовок',
                        'fake' => true,
                        'store_in' => 'extras'
                    ]);
                    
        // Compensation
                    
        $this->crud->addField([   // CustomHTML
            'name' => 'content_separator_1',
            'type' => 'custom_html',
            'value' => '<br><h2>Compensation</h2><hr>',
        ]);
        
        $this->crud->addField([
            'name' => 'compensation_mt_1',
            'label' => 'Compensation main title',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        $this->crud->addField([
            'name' => 'compensation_t_1',
            'label' => 'Compensation title 1',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        $this->crud->addField([
            'name' => 'compensation_c_1',
            'label' => 'Compensation content 1',
            'type' => 'wysiwyg',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        
        $this->crud->addField([
            'name' => 'compensation_t_2',
            'label' => 'Compensation title 2',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        $this->crud->addField([
            'name' => 'compensation_c_2',
            'label' => 'Compensation content 2',
            'type' => 'wysiwyg',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        
        $this->crud->addField([
            'name' => 'compensation_t_3',
            'label' => 'Compensation title 3',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        $this->crud->addField([
            'name' => 'compensation_c_3',
            'label' => 'Compensation content 3',
            'type' => 'wysiwyg',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        
        // Partner Program
        $this->crud->addField([   // CustomHTML
            'name' => 'content_separator_2',
            'type' => 'custom_html',
            'value' => '<br><h2>Partner Program</h2><hr>',
        ]);
        $this->crud->addField([
            'name' => 'program_mt_1',
            'label' => 'Program main title',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        $this->crud->addField([
            'name' => 'partner_program_info',
            'label' => 'Partner Program info',
            'type' => 'wysiwyg',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        
        // How it works?
        $this->crud->addField([   // CustomHTML
            'name' => 'content_separator_3',
            'type' => 'custom_html',
            'value' => '<br><h2>How it works?</h2><hr>',
        ]);
        
        $this->crud->addField([
            'name' => 'htw_mt_1',
            'label' => 'How it works main title',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        $this->crud->addField([
            'name' => 'program_t_1',
            'label' => 'Program title 1',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        $this->crud->addField([
            'name' => 'program_c_1',
            'label' => 'Program content 1',
            'type' => 'wysiwyg',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        
        $this->crud->addField([
            'name' => 'program_t_2',
            'label' => 'Program title 2',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        $this->crud->addField([
            'name' => 'program_c_2',
            'label' => 'Program content 2',
            'type' => 'wysiwyg',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        
        $this->crud->addField([
            'name' => 'program_t_3',
            'label' => 'Program title 3',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        $this->crud->addField([
            'name' => 'program_c_3',
            'label' => 'Program content 3',
            'type' => 'wysiwyg',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        
        $this->crud->addField([
            'name' => 'htw_info',
            'label' => 'How it works info',
            'type' => 'wysiwyg',
            'fake' => true,
            'store_in' => 'extras',
        ]);
        
        
    }
}