<?php

class ElementaryTest extends PHPUnit_Framework_TestCase
{
    public function testSettingAndGettingAnOption()
    {
        $elementary = $this->getMockForTrait('Koenvu\Forms\Components\Elementary');
        $elementary->set('test', 'SomeValue');
        $elementary->set('hey', 'Hello!');

        $this->assertEquals('Hello!', $elementary->get('hey'));
        $this->assertEquals('SomeValue', $elementary->get('test'));
    }

    public function testHasAnOption()
    {
        $elementary = $this->getMockForTrait('Koenvu\Forms\Components\Elementary');
        $elementary->set('test', 'SomeValue');
        $elementary->set('multi', ['dimensional' => 'thing']);

        $this->assertTrue($elementary->has('test'));
        $this->assertFalse($elementary->has('random'));
        $this->assertTrue($elementary->has('multi.dimensional'));
        $this->assertFalse($elementary->has('something.dimensional'));
    }

    public function testSettingGettingAndPullingAnOption()
    {
        $elementary = $this->getMockForTrait('Koenvu\Forms\Components\Elementary');
        $elementary->set('test', 'SomeValue');

        $this->assertEquals('SomeValue', $elementary->get('test'));
        $this->assertEquals('SomeValue', $elementary->pull('test'));
        $this->assertNull($elementary->get('test'));
        $this->assertNull($elementary->pull('test'));
    }

    public function testGettingOptionWithDefault()
    {
        $elementary = $this->getMockForTrait('Koenvu\Forms\Components\Elementary');
        $this->assertEquals('Default', $elementary->get('random-key', 'Default'));
        $this->assertNull($elementary->get('another-key'));
    }

    public function testGettingSingleAttribute()
    {
        $elementary = $this->getMockForTrait('Koenvu\Forms\Components\Elementary');
        $elementary->set('value', 'Special&Case"');
        $this->assertRegExp('/value\s*=\s*([\'"])Special&amp;Case&quot;\1/', $elementary->attr('value'));
        $this->assertRegExp('/random\s*=\s*([\'"])Default\1/', $elementary->attr('random', 'Default'));

        $this->assertEquals('', $elementary->attr('empty'));
    }

    public function testGettingMultipleAttribute()
    {
        $elementary = $this->getMockForTrait('Koenvu\Forms\Components\Elementary');
        $elementary->set('wrapper', [
            'value' => 'SomeValue',
            'greet' => 'Hello'
        ]);
        $this->assertRegExp('/value\s*=\s*([\'"])SomeValue\1/', $elementary->attr('wrapper'));
        $this->assertRegExp('/greet\s*=\s*([\'"])Hello\1/', $elementary->attr('wrapper'));
    }
}
