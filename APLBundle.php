<?php

/**
 *
 * Copyright 2014 Simon Mönch.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\Bundle\APLBundle;

use APL\Bundle\APLBundle\DependencyInjection\Compiler\AddEventListenerPass;
use APL\Bundle\APLBundle\DependencyInjection\Compiler\AddUseCasePass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class APLBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AddUseCasePass());
        $container->addCompilerPass(new AddEventListenerPass());
    }
}
