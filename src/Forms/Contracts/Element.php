<?php

namespace Koenvu\Forms\Contracts;

interface Element
{
    /**
     * Render and return the HTML for the element.
     *
     * @return string
     */
    public function render();
}
