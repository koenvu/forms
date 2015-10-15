<?php

namespace Koenvu\FormTests\Components;

use PHPUnit_Framework_TestCase;

class PropagatorTest extends PHPUnit_Framework_TestCase
{
    public function testPropagatesCorrectly()
    {
        $propagator = $this->getMockForAbstractClass('Koenvu\FormTests\Stubs\TestablePropagator');
        $propagator->setPropagatorOptions(['template_prefix', 'someoption']);

        $propagator->set('template_prefix', 'prefix::');
        $propagator->set('someoption', 'noitpo');

        $fieldA = $this->getMockForAbstractClass('Koenvu\FormTests\Stubs\TestableLabeller');
        $fieldB = $this->getMockForAbstractClass('Koenvu\FormTests\Stubs\TestableLabeller');

        $fieldB->set('someoption', 'unchanged');

        $propagator->propagateSettingsTo([$fieldA, $fieldB]);

        $this->assertEquals('prefix::', $fieldA->get('template_prefix'));
        $this->assertEquals('prefix::', $fieldB->get('template_prefix'));

        $this->assertEquals('noitpo', $fieldA->get('someoption'));
        $this->assertEquals('unchanged', $fieldB->get('someoption'));
    }

    /**
     * @expectedException Koenvu\Forms\Components\Exceptions\PropagatorException
     */
    public function testThrowingException()
    {
        $propagator = $this->getMockForTrait('Koenvu\Forms\Components\Propagator');
        $propagator->propagateSettingsTo([]);
    }
}
