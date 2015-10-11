<?php

namespace Koenvu\FormTests\Components;

use PHPUnit_Framework_TestCase;

class ValuableTest extends PHPUnit_Framework_TestCase
{
    public function testFillingValue()
    {
        // This needs to be refactored to something more elegant / injectable
        $_GET['somename'] = 'a value';

        $valuable = $this->getMockForTrait('Koenvu\Forms\Components\Valuable');
        $field = $this->getMockForAbstractClass('Koenvu\FormTests\Stubs\TestableField');
        $field->set('field.name', 'somename');

        $valuable->fillValues([$field]);

        $this->assertRegExp('/value\s*=\s*([\'"])a value\1/', $field->attr('field'));
    }

    public function testFillingValueWithoutName()
    {
        $valuable = $this->getMockForTrait('Koenvu\Forms\Components\Valuable');
        $field = $this->getMockForAbstractClass('Koenvu\FormTests\Stubs\TestableField');

        $valuable->fillValues([$field]);

        $this->assertEquals('', $field->attr('field'));
    }
}
