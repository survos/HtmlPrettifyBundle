<?php

namespace Tacman\HtmlPrettifyBundle;

use Gajus\Dindent\Indenter;
use Gedmo\Mapping\Annotation\Tree;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\UX\Chartjs\Twig\ChartExtension;
use Symfony\WebpackEncoreBundle\Twig\StimulusTwigExtension;
use Tacman\HtmlPrettifyBundle\Twig\HelloExtension;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Tacman\HtmlPrettifyBundle\Twig\HtmlPrettifyExtension;
use Twig\Environment;

class TacmanHtmlPrettifyBundle extends AbstractBundle
{

    protected string $extensionAlias = 'prettify_html';

    // $config is the bundle Configuration that you usually process in ExtensionInterface::load() but already merged and processed
    /**
     * @param array<mixed> $config
     */
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $builder->autowire('gajus_indenter', Indenter::class)
            ->setPublic(true);
//        $definition = $builder->autowire('tacman.hello_twig', HelloExtension::class)
//            ->addTag('twig.extension');

        if (class_exists(Environment::class) && class_exists(StimulusTwigExtension::class)) {
            $builder
                ->setDefinition('tacman.html_pretty', new Definition(HtmlPrettifyExtension::class))
//                ->addArgument(new Reference('webpack_encore.twig_stimulus_extension'))
//                ->addArgument(new Reference('gajus_indenter'))
                ->addTag('twig.extension')
                ->setPublic(false)
            ;
        }

//        $definition->setArgument('$widthFactor', $config['widthFactor']);
//        $definition->setArgument('$height', $config['height']);
//        $definition->setArgument('$foregroundColor', $config['foregroundColor']);
    }

    public function configure(DefinitionConfigurator $definition): void
    {
        // since the configuration is short, we can add it here
        $definition->rootNode()
            ->children()
            ->scalarNode('widthFactor')->defaultValue(2)->end()
            ->scalarNode('height')->defaultValue(30)->end()
            ->scalarNode('foregroundColor')->defaultValue('green')->end()
            ->end();

        ;
    }



}
