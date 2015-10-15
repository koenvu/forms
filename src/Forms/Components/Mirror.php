<?php

namespace Koenvu\Forms\Components;

use Koenvu\Forms\Contracts\FormElement;
use Koenvu\Forms\Components\Exceptions\MirrorException;

trait Mirror
{
    /**
     * Mirror specified options to their destinations with this element.
     *
     * @throws MirrorException
     */
    public function mirrorOptions()
    {
        // Check if this class is an instance of FormElement.
        // This is important because we are assuming that
        // set and get methods are available for use.
        if (! ($this instanceof FormElement)) {
            throw new MirrorException(get_class($this) . " does not implement FormElement");
        }

        $mirrorOptions = [];

        // Mirror options are retrieved from the mirrorOptions property
        if (property_exists($this, "mirrorOptions")) {
            $mirrorOptions = $this->mirrorOptions;
        }

        // Loop through the options and assign them to the fields
        foreach ($mirrorOptions as $option => $destinations) {
            // Cast destinations to an array. When it was a string
            // before it will now be an array with one element,
            // ready to be looped through and processed.
            $destinations = (array) $destinations;
            $value = $this->get($option);

            // Copy it to all destinations, except if the
            // destination already has a value. In that
            // case, we just skip the mirror action.
            foreach ($destinations as $destination) {
                if (! $this->has($destination)) {
                    $this->set($destination, $value);
                }
            }
        }
    }
}
