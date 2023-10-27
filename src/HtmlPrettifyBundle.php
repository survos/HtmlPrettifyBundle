<?php

namespace Survos\HtmlPrettifyBundle;

use Gajus\Dindent\Indenter;
use Survos\CoreBundle\HasAssetMapperInterface;
use Survos\CoreBundle\Traits\HasAssetMapperTrait;
use Survos\HtmlPrettifyBundle\Twig\HtmlPrettifyExtension;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\WebpackEncoreBundle\Twig\StimulusTwigExtension;
use Twig\Environment;

class HtmlPrettifyBundle extends AbstractBundle implements HasAssetMapperInterface
{
    use HasAssetMapperTrait;
    protected string $extensionAlias = 'prettify_html';

    // $config is the bundle Configuration that you usually process in ExtensionInterface::load() but already merged and processed
    /**
     * @param array<mixed> $config
     */
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $builder->autowire('gajus_indenter', Indenter::class)
            ->setPublic(true);

        $builder
            ->setDefinition('survos.html_pretty', new Definition(HtmlPrettifyExtension::class))
//                ->addArgument(new Reference('webpack_encore.twig_stimulus_extension'))
//                ->addArgument(new Reference('gajus_indenter'))
            ->addTag('twig.extension')
            ->setPublic(false)
        ;

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

    public function getPaths(): array
    {
        $dir = realpath(__DIR__.'/../assets/');
        assert(file_exists($dir), 'asset path must exist for the assets in ' . __DIR__);
        return [$dir => '@survos/html-prettyify'];
    }


}
