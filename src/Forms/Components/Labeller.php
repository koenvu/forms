<?php

namespace Koenvu\Forms\Components;

/**
 * Component to automatically enhance labels for a field
 */
trait Labeller
{
    /**
     * Enhance fields by adding information for labels.
     *
     * @param [FormElement] $fields Array of FormElement objects
     * @param boolean $generateIds Should fields automatically get an ID tag added if they do not exist?
     * @param callback $generatorCallback This callback will be used to generate an ID when required
     */
    public function enhanceLabels($fields = [], $generateIds = false, $generatorCallback = 'spl_object_hash')
    {
        foreach ($fields as $field) {
            if ($field->get('field.id') === null && $generateIds) {
                // Attempt to generate the id based on the name
                // option if it exists, or generate the hash
                // of the field object as fallback name.
                $identifier = $field->get('field.name', call_user_func($generatorCallback, $field));
                $field->set('field.id', $identifier);
            }

            // Now try to retrieve the ID again and assign it
            // to the label.for attribute if it exists. If
            // we just generated an ID, it surely will.
            if ($identifier = $field->get('field.id')) {
                $field->set('label.for', $identifier);
            }
        }
    }
}
