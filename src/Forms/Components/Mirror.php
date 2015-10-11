<?php

namespace Koenvu\Forms\Components;

use Koenvu\Forms\Contracts\FormElement;
use Koenvu\Forms\Components\Exceptions\MirrorException;

/**
 * Component that helps mirroring options from the form to its elements
 *
 * This component expects to be used on a class
 * that implements FormElement. It will throw
 * an exception if that is not the case.
 */
trait Mirror
{
    /**
     * Mirror options to specified fields
     *
     * @param [FormElement] $fields
     * @throws Exception
     */
    public function mirrorOptions($fields)
    {
        // Check if this class is an instance of FormElement
        if (! ($this instanceof FormElement)) {
            throw new MirrorException(get_class($this) . " does not implement FormElement");
        }

        $mirrorOptions = [];

        // Mirror options are retrieved from the mirrorOptions property
        if (property_exists($this, "mirrorOptions")) {
            $mirrorOptions = (array) $this->mirrorOptions;
        }

        // Loop through the options and assign them to the fields
        foreach ($mirrorOptions as $option) {
            $value = $this->get($option);

            array_walk($fields, function ($field) use ($option, $value) {
                $field->set($option, $value);
            });
        }
    }
}
