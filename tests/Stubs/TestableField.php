<?php

namespace Koenvu\FormTests\Stubs;

use Koenvu\Forms\Contracts\FormElement;
use Koenvu\Forms\Components\Elementary;

abstract class TestableField implements FormElement
{
    use Elementary;
}
