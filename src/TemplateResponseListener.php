<?php

namespace Glaubinix\TemplateResponse;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\Templating\EngineInterface;

class TemplateResponseListener
{
    /**
     * @var EngineInterface
     */
    private $engine;

    /**
     * @param EngineInterface $engine
     */
    public function __construct(EngineInterface $engine)
    {
        $this->engine = $engine;
    }

    /**
     * @param FilterResponseEvent $event
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        $response = $event->getResponse();
        if ($response instanceof TemplateResponse) {
            $response->render($this->engine);
        }
    }
}
