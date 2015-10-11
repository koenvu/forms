<?php

namespace Koenvu\Forms\Components;

trait Elementary
{
    protected $options;

    /**
     * Set an option
     *
     * @param string $name
     * @param mixed $value
     * @return $this Must return the object itself for chaining
     */
    public function set($name, $value)
    {
        array_set($this->options, $name, $value);
        return $this;
    }

    /**
     * Retrieve an option
     *
     * @param string $name
     * @param mixed $default
     * @return mixed $value
     */
    public function get($name, $default = null)
    {
        return array_get($this->options, $name, $default);
    }

    /**
     * Check if the element has a given option
     *
     * @param string $name
     */
    public function has($name)
    {
        return array_has($this->options, $name);
    }

    /**
     * Retrieve an option and remove it from the options array
     *
     * @param string $name
     * @param mixed $default
     * @return mixed $value
     */
    public function pull($name, $default = null)
    {
        return array_pull($this->options, $name, $default);
    }

    /**
     * Compose an HTML attribute string for the given attribute.
     *
     * When the value corresponding to attr is an array, this function should
     * generate a set of attributes corresponding to the keys of the array.
     * Otherwise it will generate HTML code for the requested attribute.
     *
     * @param  string $name
     * @return string The composed attribute(s)
     */
    public function attr($name, $default = null)
    {
        $value = $this->get($name, $default);

        if (! is_array($value)) {
            // If the value is not an array, we will just create a single attribute
            if ($value !== null) {
                return " {$name}=\"" . e($value) . "\"";
            }

            // The value must've been null, so lets just return an empty string
            return '';
        }

        // If the value is an array we will, non-recursively,
        // loop through the array. For every key found, an
        // attribute with its value will be generated.
        $result = '';
        foreach ($value as $attribute => $contents) {
            $attributeValue = $this->get($name . '.' . $attribute);
            $result .= " {$attribute}=\"" . htmlentities($attributeValue, ENT_QUOTES, 'UTF-8', false) . "\"";
        }
        return $result;
    }
}
