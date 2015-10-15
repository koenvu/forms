<?php

namespace Koenvu\Forms\Components;

trait Valuable
{
    /**
     * Fill the field.value option of a field.
     *
     * @param [FormElement] $fields Array of FormElement objects
     */
    public function fillValues($fields = [])
    {
        $inputParameters = $_POST + $_GET;
        foreach ($fields as $field) {
            if (($name = $field->get('field.name')) && isset($inputParameters[$name])) {
                $field->set('field.value', $inputParameters[$name]);
            }
        }
    }
}
