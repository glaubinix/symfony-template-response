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

        $engine = $this->getMock('Symfony\Component\Templating\EngineInterface');

        $content = 'context';

        $engine
            ->expects($this->once())
            ->method('render')
            ->with($this->equalTo($template), $this->equalTo($context))
            ->will($this->returnValue($content));

        $response->render($engine);

        $this->assertEquals($content, $response->getContent());
    }
}
