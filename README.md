symfony-template-response
=======================

Build status: [![Build Status](https://travis-ci.org/glaubinix/symfony-template-response.png?branch=master)](https://travis-ci.org/glaubinix/symfony-template-response)


Using the TemplateResponse will help you to build Controllers which are not tightly coupled to a certain Framework. In the case of Symfony/Silex this mostly means not injecting the ServiceContainer/Application to your Controllers.

Installation
------------

The easiest way to install this library is to use [Composer](http://getcomposer.org/).
Add the package "glaubinix/symfony-template-response" to your composer.json.

```json
{
    "require": {
        "glaubinix/symfony-template-response": "@stable"
    }
}
```

Usage
-----
To be able to use the TemplateResponse simply register the Listener.

#### Usage with symfony framework bundle
If you are using the framework bundle simply add this to your service config.
````xml
<service id="template_response.view_listener" class="Glaubinix\TemplateResponse\TemplateResponseListener%">
    <argument type="service" id="templating" />

    <tag name="kernel.event_listener" event="kernel.view" method="onKernelResponse" priority="10" />
</service>
````

#### Usage with silex and twig
If you are using silex make sure the templating Engine is registered then register the ServiceProvider which is provided with this library.

````php
// In a Provider define the templating engine
$app['templating'] = function(Container $app) {
    return new Symfony\Bridge\Twig\TwigEngine($app['twig'], new \Symfony\Component\Templating\TemplateNameParser());
};

// Register the provider
$app->register(new Glaubinix\TemplateResponse\Silex\TemplateResponseServiceProvider());

// Use the response in 
$app->get('/', function() {
    return new TemplateResponse('template', []);
});
````

Notes
-----

To make this fully decoupled from Frameworks the TemplateResponse would not have to extend the Symfony Response and instead of simply rendering the content we would have to replace the Response. Once this is done a dedicated ResponseListener for every Framework would allow the usage in all Frameworks.

Maintaing sounds like a huge pain and I dont really see this happening :)


Original idea
-------------

First time I saw this idea was in  [QafooLabsNoFrameworkBundle](https://github.com/QafooLabs/QafooLabsNoFrameworkBundle/) the implementation is slightly different and depends on the symfony framework bundle which is main the reason I build a simple version for silex. 
