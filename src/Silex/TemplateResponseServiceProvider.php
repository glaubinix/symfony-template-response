<?php

namespace Glaubinix\TemplateResponse\Silex;

use Glaubinix\TemplateResponse\TemplateResponseListener;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Api\EventListenerProviderInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class TemplateResponseServiceProvider implements ServiceProviderInterface, EventListenerProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['template_response.listener'] = function (Container $pimple) {
            return new TemplateResponseListener($pimple['templating']);
        };
    }

    public function subscribe(Container $app, EventDispatcherInterface $dispatcher)
    {
        $dispatcher->addSubscriber($app['template_response.listener']);
    }
}
