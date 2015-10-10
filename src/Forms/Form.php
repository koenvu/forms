<?php

namespace Koenvu\Forms;

use Koenvu\Forms\Helpers\Valuable;
use Illuminate\Contracts\View\Factory;
use Koenvu\Forms\Contracts\FormElement;

/**
 * Easy form builder based on blade templates
 */
class Form implements FormElement
{
    use Elementary, Valuable;
    
    protected $viewFactory;

    /**
     * Create a new instance and inject a view factory
     * 
     * @param Factory $viewFactory
     */
    public function __construct(Factory $viewFactory)
    {
        $this->viewFactory = $viewFactory;
        $this->init();
    }
    
    /**
     * Initializes the form
     */
    protected function init()
    {
        
    }

    /**
     * @var array
     */
    protected $fields = [];

    /**
     * Add a new field to the form
     * 
     * @param FormField $field
     */
    public function addField(FormElement $field)
    {
        $this->fields[] = $field;
    }

    /**
     * Render the form and its fields
     *
     * @return string
     */
    public function render()
    {
        // Fill all fields right before the render
        $this->fillValues();
        
        $fieldContents = '';
        foreach ($this->fields as $field) {
            $fieldContents .= $field->render();
        }
        
        return $this->viewFactory->make('form', ['fields' => $fieldContents])->render();
    }
}
