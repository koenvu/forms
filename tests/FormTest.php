<?php

use Koenvu\Forms\Form;

class FormTest extends PHPUnit_Framework_TestCase
{
    public function testSomething()
    {
        $fieldA = $this->getMockBuilder('Koenvu\Forms\Contracts\FormElement')->getMock();
        $fieldA->method('render')->willReturn('some output');
        
        $fieldB = $this->getMockBuilder('Koenvu\Forms\Contracts\FormElement')->getMock();
        $fieldB->method('render')->willReturn('...hello');
        
        $view = $this->getMockBuilder('Illuminate\View\View')
                     ->disableOriginalConstructor()
                     ->setMethods(['render'])
                     ->getMock();
        $view->method('render')->willReturn('some output...hello');
        
        $factory = $this->getMockBuilder('Illuminate\View\Factory')
                        ->disableOriginalConstructor()
                        ->setMethods(['make'])
                        ->getMock();
        $factory->method('make')->willReturn($view);

        $form = new Form($factory);
        $form->addField($fieldA);
        $form->addField($fieldB);

        $result = $form->render();
        
        $expected = $fieldA->render() . $fieldB->render();
        $this->assertEquals($expected, $result);
    }
}