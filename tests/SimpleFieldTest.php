<?php

namespace Koenvu\FormTests;

use Koenvu\Forms\SimpleField;
use PHPUnit_Framework_TestCase;

class SimpleFieldTest extends PHPUnit_Framework_TestCase
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

    public function testGeneratesCorrectTemplateName()
    {
        $field = new SimpleField($this->factory);

        $field->set('template_prefix', 'prefix::');
        $field->set('template', 'view-name');

        // Expect the view to receive the correct
        // template name, and that it contains
        // the field in its view parameters
        $this->factory->expects($this->once())
                      ->method('make')
                      ->with($this->equalTo('prefix::view-name'), $this->contains($field));

        $this->view->expects($this->once())->method('render');

        $field->render();
    }

    public function testMirrorsNameToId()
    {
        $field = new SimpleField($this->factory);

        $field->set('field.name', 'username');

        // Render triggers the copy action
        $field->render();

        $this->assertEquals('username', $field->get('field.id'));

        // Random check
        $this->assertNull($field->get('username'));
    }
}
