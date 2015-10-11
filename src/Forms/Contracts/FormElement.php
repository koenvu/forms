<?php

namespace Koenvu\Forms\Contracts;

/**
 * Contract for a FormElement
 */
interface FormElement extends Element
{
    /**
     * Set an option
     *
     * @param string $name
     * @param mixed $value
     * @return $this Must return the object itself for chaining
     */
    public function set($name, $value);

    /**
     * Retrieve an option
     *
     * @param string $name
     * @param mixed $default
     * @return mixed $value
     */
    public function get($name, $default = null);

    /**
     * Check if the element has a given option
     *
     * @param string $name
     */
    public function has($name);

    /**
     * Compose an HTML attribute string for the given attribute.
     *
     * When the value corresponding to attr is an array, this function should
     * generate a set of attributes corresponding to the keys of the array.
     * Otherwise it will generate HTML code for the requested attribute.
     *
     * @param string $name
     * @param string $default
     * @return string The composed attribute(s)
     */
    public function attr($name, $default = null);
}
