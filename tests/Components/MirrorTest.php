<?php

namespace Koenvu\FormTests\Components;

use PHPUnit_Framework_TestCase;
use Koenvu\Forms\Components\Elementary;
use Koenvu\Forms\Contracts\FormElement;

class MirrorTest extends PHPUnit_Framework_TestCase
{
    public function testMirroring()
    {
        $mirror = $this->getMockForAbstractClass('Koenvu\FormTests\Stubs\TestableMirror');
        $field = $this->getMockForAbstractClass('Koenvu\FormTests\Stubs\TestableField');

        $mirror->setMirrorOptions(['a', 'sub.b']);
        $mirror->set('a', 'art');
        $mirror->set('sub.b', 'beautiful');
        $mirror->set('c', 'correct');

        $mirror->mirrorOptions([$field]);

        $this->assertEquals('art', $field->get('a'));
        $this->assertEquals('beautiful', $field->get('sub.b'));
        $this->assertNull($field->get('c'));
    }

    /**
     * @expectedException Koenvu\Forms\Components\Exceptions\MirrorException
     */
    public function testThrowingException()
    {
        $mirror = $this->getMockForTrait('Koenvu\Forms\Components\Mirror');
        $mirror->mirrorOptions([]);
    }
}
