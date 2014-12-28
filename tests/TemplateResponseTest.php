<?php

namespace Glaubinix\Test\TemplateResponse;

use Glaubinix\TemplateResponse\TemplateResponse;

class TemplateResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testRender()
    {
        $template = 'template';
        $context = [];
        $response = new TemplateResponse($template, $context);

        $twig = $this->getMock('\Twig_Environment');

        $content = 'context';

        $twig
            ->expects($this->once())
            ->method('render')
            ->with($this->equalTo($template), $this->equalTo($context))
            ->will($this->returnValue($content));

        $response->render($twig);

        $this->assertEquals($content, $response->getContent());
    }
}
