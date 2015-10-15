<?php

namespace Koenvu\Forms\Components;

trait Labeller
{
    /**
     * Enhance field by adding information to the label.
     *
     * @param boolean $generateIds Should fields automatically get an ID tag added if they do not exist?
     * @param callback $generatorCallback This callback will be used to generate an ID when required
     */
    public function enhanceLabels($generateIds = false, $generatorCallback = 'spl_object_hash')
    {
        if ($this->get('field.id') === null && $generateIds) {
            // Attempt to generate the id based on the name
            // option if it exists, or generate the hash
            // of the field object as fallback name.
            $identifier = $this->get('field.name', call_user_func($generatorCallback, $this));
            $this->set('field.id', $identifier);
        }

        // Now try to retrieve the ID again and assign it
        // to the label.for attribute if it exists. If
        // we just generated an ID, it surely will.
        if ($identifier = $this->get('field.id')) {
            $this->set('label.for', $identifier);
        }
    }
}
