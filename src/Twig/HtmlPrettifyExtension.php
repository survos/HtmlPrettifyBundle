<?php

namespace Tacman\HtmlPrettifyBundle\Twig;

use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Symfony\WebpackEncoreBundle\Twig\StimulusTwigExtension;

class HtmlPrettifyExtension extends AbstractExtension
{
    public function __construct(private StimulusTwigExtension $stimulus)
    {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('prettify', [$this, 'make_pretty'], ['needs_environment' => true, 'is_safe' => ['html']]),
        ];
    }

    public function renderHello(Environment $env, array $attributes = []): string
    {

        $controllers = [];
        $controllers['@tacman/html-prettify-bundle/prettify'] = $attributes;

        $html = '<div '.$this->stimulus->renderStimulusController($env, $controllers).' ';
//        foreach ($attributes as $name => $value) {
//            if ('data-controller' === $name) {
//                continue;
//            }
//
//            if (true === $value) {
//                $html .= $name.'="'.$name.'" ';
//            } elseif (false !== $value) {
//                $html .= $name.'="'.$value.'" ';
//            }
//        }

        return trim($html).'></div>';
    }

}
