<?php

namespace Koenvu\FormTests\Stubs;

use Koenvu\Forms\Components\Labeller;
use Koenvu\Forms\Components\Elementary;
use Koenvu\Forms\Contracts\FormElement;

abstract class TestableLabeller implements FormElement
{
    use Labeller, Elementary;
}
