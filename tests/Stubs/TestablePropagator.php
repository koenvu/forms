<?php

namespace Koenvu\FormTests\Stubs;

use Koenvu\Forms\Components\Elementary;
use Koenvu\Forms\Components\Propagator;
use Koenvu\Forms\Contracts\FormElement;

abstract class TestablePropagator implements FormElement
{
    use Propagator, Elementary;

    protected $propagatorOptions = [];

    public function setPropagatorOptions($options)
    {
        $this->propagatorOptions = $options;
    }
}
