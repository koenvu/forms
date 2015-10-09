<?php

namespace Koenvu\Forms;

use View;
use Illuminate\Contracts\View\Factory;
use Koenvu\Forms\Contracts\FormElement;

/**
 * Easy form builder based on blade templates
 */
class Form implements FormElement
{
    use Elementary;
    
    protected $viewFactory;

    /**
     * Create a new instance and inject a view factory
     * 
     * @param Factory $viewFactory
     */
    public function __construct(Factory $viewFactory)
    {
        $this->viewFactory = $viewFactory;
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
        $fieldContents = '';
        foreach ($this->fields as $field) {
            $fieldContents .= $field->render();
        }
        
        return $this->viewFactory->make('form', ['fields' => $fieldContents])->render();
    }
}
