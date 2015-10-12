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
        $this->container = $this->getMockBuilder('Illuminate\Container\Container')
                                ->disableOriginalConstructor()
                                ->setMethods(['make'])
                                ->getMock();

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

        $form = new Form($this->factory, $this->container);
        $form->addField($fieldA);
        $form->addField($fieldB);

        $result = $form->render();

        $expected = $fieldA->render() . $fieldB->render();
        $this->assertEquals($expected, $result);
    }

    public function testCreatingField()
    {
        $field = $this->getMockBuilder('Koenvu\FormTests\Stubs\TestableField')
                      ->setMethods(['render'])
                      ->disableOriginalConstructor()
                      ->setMockClassName('MockingField')
                      ->getMockForAbstractClass();

        $this->container->method('make')->willReturn($field);

        $form = new Form($this->factory, $this->container);
        $returnedField = $form->createField(MockingField::class, ['test' => 'val']);

        // When the form renders, we expect the field to get a render call as well
        $returnedField->expects($this->once())->method('render');

        $this->assertEquals('val', $returnedField->get('test'));

        $form->render();
    }

    public function testFillingValues()
    {
        $_GET['somename'] = 'a value';
        $form = new Form($this->factory, $this->container);
        $field = $this->getMockForAbstractClass('Koenvu\FormTests\Stubs\TestableField');
        $field->set('field.name', 'somename');

        $form->addField($field);
        $form->render();

        $this->assertRegExp('/value\s*=\s*([\'"])a value\1/', $field->attr('field'));
    }

    // public function testMirroringOptions()
    // {
    //     $form = new Form($this->factory, $this->container);
    //     $fieldA = $this->getMockForAbstractClass('Koenvu\FormTests\Stubs\TestableField');
    //     $fieldB = $this->getMockForAbstractClass('Koenvu\FormTests\Stubs\TestableField');

    //     $form->addField($fieldA);
    //     $form->addField($fieldB);

    //     // template_prefix is a mirror option in form and should be copied
    //     $form->set('template_prefix', 'someprefix::');

    //     // non_mirror is not a mirror option in form and should not be copied
    //     $form->set('non_mirror', 'hello');

    //     // rendering will trigger the mirror functionality
    //     $form->render();

    //     $this->assertEquals('someprefix::', $fieldA->get('template_prefix'));
    //     $this->assertEquals('someprefix::', $fieldB->get('template_prefix'));

    //     $this->assertNull($fieldA->get('non_mirror'));
    //     $this->assertNull($fieldB->get('non_mirror'));
    // }
}
