<?php

namespace Koenvu\FormTests;

use PHPUnit_Framework_TestCase;
use Koenvu\Forms\FormServiceProvider;

class FormServiceProviderTest extends PHPUnit_Framework_TestCase
{
    protected $app;

    public function setUp()
    {
        $this->app = $this->getMockBuilder('Illuminate\Contracts\Foundation\Application')
                          ->disableOriginalConstructor()
                          ->getMock();
    }

    public function testBooting()
    {
        // $provider = new FormServiceProvider($this->app);
        // $provider->boot();
    }

    public function testRegistering()
    {
        // $provider = new FormServiceProvider($this->app);
        // $provider->register();
    }
}
