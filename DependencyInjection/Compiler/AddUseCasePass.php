<?php

/**
 *
 * Copyright 2014 Simon Mönch.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\Bundle\APLBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class AddUseCasePass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $commands = $container->findTaggedServiceIds('apl.use_case');

        foreach ($commands as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {
                $dispatcherId = isset($attributes['dispatcher']) ? $attributes['dispatcher'] : 'apl.dispatcher';
                $dispatcher   = $container->getDefinition($dispatcherId);

                $dispatcher->addMethodCall('registerCommand', array($attributes['command'], new Reference($id)));
            }
        }
    }
}
