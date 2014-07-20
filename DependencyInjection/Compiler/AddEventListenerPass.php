<?php

/**
 *
 * Copyright 2014 Simon Mönch.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\Bundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class AddEventListenerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $listeners = $container->findTaggedServiceIds('apl.event_listener');

        foreach ($listeners as $id => $attributes) {

            $dispatcherId = isset($attributes['dispatcher']) ? $attributes['dispatcher'] : 'apl.event_dispatcher';
            $dispatcher   = $container->getDefinition($dispatcherId);

            $dispatcher->addMethodCall(
                'addListener',
                array(
                    $attributes['event'],
                    new Reference($id),
                    isset($attributes['priority']) ? $attributes['priority'] : 0
                )
            );
        }
    }
}
