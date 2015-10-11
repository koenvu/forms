<?php

require __DIR__ . '/vendor/autoload.php';

// Some mockable classes for the tests
abstract class TestableField implements Koenvu\Forms\Contracts\FormElement
{
    use Koenvu\Forms\Components\Elementary;
}
