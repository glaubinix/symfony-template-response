<?php

namespace Glaubinix\Test\TemplateResponse;

use Glaubinix\TemplateResponse\TemplateResponse;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Templating\EngineInterface;

class TemplateResponseTest extends TestCase
{
    public function testRender()
    {
        $template = 'template';
        $context = [];
        $response = new TemplateResponse($template, $context);

        $engine = $this->getMockBuilder(EngineInterface::class)->getMock();

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
