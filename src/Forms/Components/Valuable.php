<?php

namespace Koenvu\Forms\Components;

trait Valuable
{

    /**
     * Fill the field.value option of a field based
     */
    public function fillValues()
    {
        $inputParameters = $_POST + $_GET;
        foreach ($this->fields as $field)
        {
            if (($name = $field->get('name')) && isset($inputParameters[$name]))
            {
                $field->set('field.value', $inputParameters[$name]);
            }
        }
    }
}
