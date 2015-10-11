<?php

namespace Koenvu\FormTests;

use Koenvu\Forms\Form;
use PHPUnit_Framework_TestCase;
use Koenvu\Forms\Components\Valuable;
use Koenvu\Forms\Components\Elementary;
use Koenvu\Forms\Contracts\FormElement;

class FormTest extends PHPUnit_Framework_TestCase
{
    protected $factory;
    protected $view;

    public function setUp()
    {
        $this->view = $this->getMockBuilder('Illuminate\View\View')
                           ->disableOriginalConstructor()
                           ->setMethods(['render'])
                           ->getMock();

        $this->factory = $this->getMockBuilder('Illuminate\View\Factory')
                              ->disableOriginalConstructor()
                              ->setMethods(['make'])
                              ->getMock();
        $this->factory->method('make')->willReturn($this->view);
    }

    protected function buildField($output = '')
    {
        $field = $this->getMockBuilder('Koenvu\Forms\Contracts\FormElement')->getMock();
        $field->method('render')->willReturn($output);
        return $field;
    }

    public function testRenderingTheForm()
    {
        $fieldA = $this->buildField('some output');
        $fieldB = $this->buildField('...hello');

        $this->view->method('render')->willReturn('some output...hello');

        $form = new Form($this->factory);
        $form->addField($fieldA);
        $form->addField($fieldB);

        $result = $form->render();

        $expected = $fieldA->render() . $fieldB->render();
        $this->assertEquals($expected, $result);
    }

    public function testFillingValues()
    {
        $_GET['somename'] = 'a value';
        $form = new Form($this->factory);
        $field = $this->getMockForAbstractClass('Koenvu\FormTests\Stubs\TestableField');
        $field->set('field.name', 'somename');

        $form->addField($field);
        $form->render();

        $this->assertRegExp('/value\s*=\s*([\'"])a value\1/', $field->attr('field'));
    }

    public function testEnhancingLabels()
    {
        $form = new Form($this->factory);
        $field = $this->getMockForAbstractClass('Koenvu\FormTests\Stubs\TestableField');
        $field->set('field.name', 'somename');
        $field->set('field.id', 'someid');

        $form->addField($field);
        $form->render();

        $this->assertRegExp('/for\s*=\s*([\'"])someid\1/', $field->attr('label.for'));
    }
}
