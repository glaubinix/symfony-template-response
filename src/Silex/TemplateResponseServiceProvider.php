<?php

namespace Glaubinix\TemplateResponse;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TemplateResponseServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Application $app
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function register(Application $app)
    {
    }

    /**
     * @param Application $app
     */
    public function boot(Application $app)
    {
        $app->after(function (Request $request, Response $response) use ($app) {
            if ($response instanceof TemplateResponse) {
                $response->render($app['twig']);
            }
        });
    }
}
