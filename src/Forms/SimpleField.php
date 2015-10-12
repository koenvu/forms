<?php

namespace Koenvu\Forms;

use Koenvu\Forms\Components\Mirror;
use Koenvu\Forms\Components\Labeller;
use Illuminate\Contracts\View\Factory;
use Koenvu\Forms\Components\Elementary;
use Koenvu\Forms\Contracts\FormElement;

class SimpleField implements FormElement
{
    use Elementary, Mirror, Labeller;

    /**
     * @var Factory
     */
    protected $viewFactory;

    /**
     * @var array
     */
    protected $mirrorOptions = ['field.name' => 'field.id'];

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
        // Mirror specified options
        $this->mirrorOptions();

        // Generate label tags
        $this->enhanceLabels(true);

        // Determine the name of the view and render it
        $view = $this->get('template_prefix', '') . $this->get('template');
        return $this->viewFactory->make($view, ['field' => $this])->render();
    }
}
