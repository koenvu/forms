When using the `Elementary` trait, a couple of things are assumed. The sections below will discuss them.

# Array dot notation

Internally `Elementary` uses the array helpers from Laravel. This means that multi-dimensional arrays can be traversed using dot notation. In the example below, both ways of accessing the array yield the same result.

````php
<?php

$options = [
    'field' => [
        'value' => 'Test',
        'name'  => 'testing'
    ],
    'label' => [
    	'text'  => 'Test'
    ]
];

var_dump(array_get($options, 'field.value'));
var_dump($options['field']['name']);
````

# Suggested naming conventions

*Note that these are only suggestions. You are free to create classes implementing the `FormElement` any way you want. The `Elementary` trait is only one possible way to implement it.*

Typically the HTML code for an HTML field consists of a wrapper, a label and a field. It is suggested to store attributes for these three elements within their respective subarray. The name for the field would go in `$options['field']['name']` (or `field.name` using the Laravel dot notation). This has the benefit of being able to call `$field->attr('field')` or `$field->attr('wrapper')` and instantly retrieve the entire attribute string for an element.

# Pulling options from an element

Instead of using `$field->get('...')` it is possible to use `$field->pull('...')`. Both calls will give you the value of the option as their return value, but the latter will also remove the value from the array.