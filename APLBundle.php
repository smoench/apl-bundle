<?php

/**
 *
 * Copyright 2014 Simon Mönch.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace APL\Bundle;

use APL\Bundle\DependencyInjection\Compiler\AddCommandPass;
use APL\Bundle\DependencyInjection\Compiler\AddEventListenerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class APLBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AddCommandPass());
        $container->addCompilerPass(new AddEventListenerPass());
    }
}
