<?php

namespace Survos\HtmlPrettifyBundle\Twig;

use Gajus\Dindent\Indenter;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\Markup;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Symfony\WebpackEncoreBundle\Twig\StimulusTwigExtension;

class HtmlPrettifyExtension extends AbstractExtension
{
//    public function __construct(private Indenter $indenter)
//    {
//    }

    public function getFilters(): array
    {
        return [
             new TwigFilter('prettify', [$this, 'make_pretty'], ['needs_environment' => true, 'is_safe' => ['html']]),
        ];
    }


    public function getFunctions(): array
    {
        return [
            new TwigFunction('prettify', [$this, 'make_pretty'], ['needs_environment' => true, 'is_safe' => ['html']]),
        ];
    }

    public function make_pretty(Environment $env, string $markup, array $attributes = []): string
    {
        $options = (new OptionsResolver())
            ->setDefaults([
                'msg' => 'prettify'
            ])->resolve($attributes);
        $msg = $options['msg'];
        $in = new Indenter();
        $pretty = sprintf("\n<!-- %s -->\n%s\n<!-- end of %s -->\n", $msg, $in->indent($markup), $msg);
        return $pretty;
    }

}
