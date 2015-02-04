symfony-template-response
=======================

Build status: [![Build Status](https://travis-ci.org/glaubinix/silex-template-response.png?branch=master)](https://travis-ci.org/glaubinix/silex-template-response)


Using the TemplateResponse will help you to build Controllers which are not tightly coupled to a certain Framework. In the case of Symfony/Silex this mostly means not injecting the ServiceContainer/Application to your Controllers.

Installation
------------

The easiest way to install this library is to use [Composer](http://getcomposer.org/)
Add the package "glaubinix/silex-template-response" to your composer.json

```json
{
    "require": {
        "glaubinix/silex-template-response": "@stable"
    }
}
```

Usage
-----

```php
// register the service provider
// make sure you also register the TwigServiceProvider
$app->register(\Glaubinix\TemplateResponse\TemplateResponseServiceProvider());

// in your controllers simply return the TemplateResponse instead of accessing $app['twig']
$app->get('/', function() {
    return new TemplateResponse('template', []);
});

```

Notes
-----

To make this fully decoupled from Frameworks the TemplateResponse would not have to extend the Symfony Response and instead of simply rendering the content we would have to replace the Response. Once this is done a dedicated ResponseListener for every Framework would allow the usage in all Frameworks.

Maintaing sounds like a huge pain and I dont really see this happening :)


Original idea
-------------

First time I saw this idea was in  [QafooLabsNoFrameworkBundle](https://github.com/QafooLabs/QafooLabsNoFrameworkBundle/) the implementation is slightly different and depends on the symfony framework bundle which is main the reason I build a simple version for silex. 
