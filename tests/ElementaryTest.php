<?php

use Koenvu\Forms\Elementary;

class TestClass {
    use Elementary;
}

class ElementaryTest extends PHPUnit_Framework_TestCase
{
    public function testSettingAndGettingAnOption()
    {
        $elementary = new TestClass();
        $elementary->set('test', 'SomeValue');
        $elementary->set('hey', 'Hello!');
        
        $this->assertEquals('Hello!', $elementary->get('hey'));
        $this->assertEquals('SomeValue', $elementary->get('test'));
    }
    
    public function testSettingGettingAndPullingAnOption()
    {
        $elementary = new TestClass();
        $elementary->set('test', 'SomeValue');
        
        $this->assertEquals('SomeValue', $elementary->get('test'));
        $this->assertEquals('SomeValue', $elementary->pull('test'));
        $this->assertNull($elementary->get('test'));
        $this->assertNull($elementary->pull('test'));
    }
    
    public function testGettingOptionWithDefault()
    {
        $elementary = new TestClass();
        $this->assertEquals('Default', $elementary->get('random-key', 'Default'));
        $this->assertNull($elementary->get('another-key'));
    }
    
    public function testGettingSingleAttribute()
    {
        $elementary = new TestClass();
        $elementary->set('value', 'Special&Case"');
        $this->assertRegExp('/value\s*=\s*([\'"])Special&amp;Case&quot;\1/', $elementary->attr('value'));
        $this->assertRegExp('/random\s*=\s*([\'"])Default\1/', $elementary->attr('random', 'Default'));
        
        $this->assertEquals('', $elementary->attr('empty'));
    }
    
    public function testGettingMultipleAttribute()
    {
        $elementary = new TestClass();
        $elementary->set('wrapper', [
            'value' => 'SomeValue',
            'greet' => 'Hello'
        ]);
        $this->assertRegExp('/value\s*=\s*([\'"])SomeValue\1/', $elementary->attr('wrapper'));
        $this->assertRegExp('/greet\s*=\s*([\'"])Hello\1/', $elementary->attr('wrapper'));
    }
}