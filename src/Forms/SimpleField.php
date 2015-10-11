<?php

namespace Koenvu\Forms;

use Illuminate\Contracts\View\Factory;
use Koenvu\Forms\Components\Elementary;
use Koenvu\Forms\Contracts\FormElement;

class SimpleField implements FormElement
{
    protected $viewFactory;

    use Elementary;

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
     * Render the field
     *
     * @return string
     */
    public function render()
    {
        // Determine the name of the view and render it
        $view = $this->get('template_prefix', '') . $this->get('template');
        return $this->viewFactory->make($view, ['field' => $this])->render();
    }
}
