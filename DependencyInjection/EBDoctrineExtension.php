<?php

namespace EB\DoctrineBundle\DependencyInjection;

use EB\DoctrineBundle\Converter\StringConverter;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class EBDoctrineExtension
 *
 * @author "Emmanuel BALLERY" <emmanuel.ballery@gmail.com>
 */
class EBDoctrineExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        // Load configuration
        $conf = $this->processConfiguration(new Configuration(), $configs);

        // Filesystem
        $container->setParameter('eb.doctrine_bundle.filesystem.web_path', $conf['filesystem']['web_path']);
        $container->setParameter('eb.doctrine_bundle.filesystem.secured_path', $conf['filesystem']['secured_path']);
        $container->setParameter('eb.doctrine_bundle.filesystem.use_env_discriminator', $conf['filesystem']['use_env_discriminator']);
        $container->setParameter('eb.doctrine_bundle.filesystem.use_class_discriminator', $conf['filesystem']['use_class_discriminator']);
        $container->setParameter('eb.doctrine_bundle.filesystem.depth', $conf['filesystem']['depth']);

        // Loggable
        $container->setParameter('eb.doctrine_bundle.loggable.persisted', $conf['loggable']['persisted']);
        $container->setParameter('eb.doctrine_bundle.loggable.updated', $conf['loggable']['updated']);
        $container->setParameter('eb.doctrine_bundle.loggable.removed', $conf['loggable']['removed']);

        // Paginator
        $container->setParameter('eb.doctrine_bundle.paginator.default_limit', $conf['paginator']['default_limit']);
        $container->setParameter('eb.doctrine_bundle.paginator.max_limit', $conf['paginator']['max_limit']);
        $container->setParameter('eb.doctrine_bundle.paginator.use_output_walker', $conf['paginator']['use_output_walker']);

        // Just dump this in the cache file
        $acc = StringConverter::getAcc();
        $container->setParameter('eb.doctrine_bundle.converter.string_converter.acc', $acc);
        $container->setParameter('eb.doctrine_bundle.converter.string_converter.accKeys', array_keys($acc));
        $container->setParameter('eb.doctrine_bundle.converter.string_converter.accValues', array_values($acc));

        // Load services
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('converter.xml');
        $loader->load('event_listener.xml');
        $loader->load('paginator.xml');
        $loader->load('param_converter.xml');
        $loader->load('twig.xml');
    }
}
