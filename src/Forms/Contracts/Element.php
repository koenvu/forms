<?php

namespace Koenvu\Forms\Contracts;

/**
 * Contract for all elements
 */
interface Element
{
    /**
     * Render and return the HTML for the element
     *
     * @return string
     */
    public function render();
}
