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

        $mirror->setMirrorOptions([
            'a' => 'sub.b',
            'b' => [
                'c',
                'd',
                'e'
            ]
        ]);
        $mirror->set('a', 'Some value');
        $mirror->set('b', 'Different');
        $mirror->set('c', 'Unchanged');

        $mirror->mirrorOptions();

        $this->assertEquals('Some value', $mirror->get('sub.b'));
        $this->assertEquals('Unchanged', $mirror->get('c'));
        $this->assertEquals('Different', $mirror->get('d'));
        $this->assertEquals('Different', $mirror->get('e'));
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
