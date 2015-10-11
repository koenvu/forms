<?php

namespace Koenvu\Forms;

use Koenvu\Forms\Components\Mirror;
use Koenvu\Forms\Components\Labeller;
use Koenvu\Forms\Components\Valuable;
use Illuminate\Contracts\View\Factory;
use Koenvu\Forms\Components\Elementary;
use Koenvu\Forms\Contracts\FormElement;
use Illuminate\Contracts\Container\Container;

/**
 * Easy form builder based on blade templates
 */
class Form implements FormElement
{
    use Elementary, Valuable, Labeller, Mirror;

    /**
     * @var Factory
     */
    protected $viewFactory;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var array
     */
    protected $fields = [];

    /**
     * @var [string]
     */
    protected $mirrorOptions = ['template_prefix'];

    /**
     * Create a new instance and inject a view factory
     *
     * @param Factory $viewFactory
     */
    public function __construct(Factory $viewFactory, Container $container)
    {
        $this->viewFactory = $viewFactory;
        $this->container = $container;
    }

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
     * Instantiate a field and add it to the form
     *
     * @param string $class
     * @param array $parameters
     * @param array $options
     * @return mixed Instance of the specified class
     */
    public function createField($class, $fieldOptions = [], $parameters = [])
    {
        $field = $this->container->make($class, $parameters);
        $this->addField($field);

        foreach ($fieldOptions as $option => $value) {
            $field->set($option, $value);
        }

        return $field;
    }

    /**
     * Render the form and its fields
     *
     * @return string
     */
    public function render()
    {
        // Fill all fields right before the render
        $this->fillValues($this->fields);

        // Generate label tags
        $this->enhanceLabels($this->fields, true);

        // Mirror options to the fields
        $this->mirrorOptions($this->fields);

        // Render all the fields and concatenate the results
        $fieldContents = '';
        foreach ($this->fields as $field) {
            $fieldContents .= $field->render();
        }

        // Generate the view name
        $viewName = $this->get('template_prefix', '') . $this->get('template', 'form');

        // Make and render the form view
        $view = $this->viewFactory->make($viewName, [
            'fields' => $fieldContents,
            'form'   => $this
        ]);
        return $view->render();
    }
}
