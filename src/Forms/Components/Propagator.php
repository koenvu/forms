<?php

namespace Koenvu\Forms\Components;

use Koenvu\Forms\Contracts\FormElement;
use Koenvu\Forms\Components\Exceptions\PropagatorException;

trait Propagator
{
    /**
     * Propagate specified options to fields
     *
     * @param [FormElement] $fields
     * @throws PropagatorException
     */
    public function propagateSettingsTo($fields)
    {
        // Check if this class is an instance of FormElement.
        // This is important because we are assuming that
        // set and get methods are available for use.
        if (! ($this instanceof FormElement)) {
            throw new PropagatorException(get_class($this) . " does not implement FormElement");
        }

        $options = [];

        // Propagation options are retrieved from the propagatorOptions property
        if (property_exists($this, 'propagatorOptions')) {
            $options = $this->propagatorOptions;
        }

        // Loop through the fields and assign the options
        foreach ($options as $option) {
            $value = $this->get($option);

            // Propagate to the fields, except if the
            // field already has a value. In that
            // case, we just skip the action.
            foreach ($fields as $field) {
                if (! $field->has($option)) {
                    $field->set($option, $value);
                }
            }
        }
    }
}
