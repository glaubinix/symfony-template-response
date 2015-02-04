<?php

namespace Glaubinix\TemplateResponse;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;

class TemplateResponse extends Response
{
    /**
     * @var string
     */
    private $template;

    /**
     * @var array
     */
    private $context;

    /**
     * @param string $template The template name
     * @param array $context An array of parameters to pass to the template
     * @param int $status The response status code
     * @param array $headers An array of response headers
     */
    public function __construct($template, $context = [], $status = 200, $headers = [])
    {
        $this->template = $template;
        $this->context = $context;

        parent::__construct('', $status, $headers);
    }

    /**
     * @param EngineInterface $engine
     */
    public function render(EngineInterface $engine)
    {
        $this->setContent($engine->render($this->template, $this->context));
    }
}
