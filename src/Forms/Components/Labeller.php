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
     */
    public function enhanceLabels($fields = [], $generateIds = false)
    {
        foreach ($fields as $field) {
            if ($field->get('field.id') === null && $generateIds) {
                // Attempt to generate the id based on the name
                // option if it exists, or generate the hash
                // of the field object as fallback name.
                $id = $field->get('field.name', spl_object_hash($field));
                $field->set('field.id', $id);
            }

            // Now try to retrieve the ID again and assign it
            // to the label.for attribute if it exists. If
            // we just generated an ID, it surely will.
            if ($id = $field->get('field.id')) {
                $field->set('label.for', $id);
            }
        }
    }
}
