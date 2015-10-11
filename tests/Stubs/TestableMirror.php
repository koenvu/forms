<?php

namespace Koenvu\FormTests\Stubs;

use Koenvu\Forms\Components\Mirror;
use Koenvu\Forms\Components\Elementary;
use Koenvu\Forms\Contracts\FormElement;

abstract class TestableMirror implements FormElement
{
    use Mirror, Elementary;

    protected $mirrorOptions = [];

    public function setMirrorOptions($options)
    {
        $this->mirrorOptions = $options;
    }
}
