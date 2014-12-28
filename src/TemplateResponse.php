<?php

namespace Glaubinix\TemplateResponse;

use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;

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
     * @param Twig_Environment $twig
     */
    public function render(Twig_Environment $twig)
    {
        $this->setContent($twig->render($this->template, $this->context));
    }
}
