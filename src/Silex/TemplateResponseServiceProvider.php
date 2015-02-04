<?php

namespace Glaubinix\TemplateResponse\Silex;

use Glaubinix\TemplateResponse\TemplateResponseListener;
use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class TemplateResponseServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Application $app
     */
    public function register(Application $app)
    {
        $app['template_response.listener'] = $app->share(function (Application $app) {
            return new TemplateResponseListener($app['templating']);
        });
    }

    /**
     * @param Application $app
     */
    public function boot(Application $app)
    {
        $app->on(KernelEvents::RESPONSE, [$app['template_response.listener'], 'onKernelResponse']);
    }
}
