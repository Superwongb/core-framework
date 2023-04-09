<?php

namespace Harryn\Jacobn\CoreFrameworkBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Harryn\Jacobn\CoreFrameworkBundle\DependencyInjection\Passes;
use Harryn\Jacobn\CoreFrameworkBundle\DependencyInjection\CoreFramework;

class UVDeskCoreFrameworkBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new CoreFramework();
    }

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container
            ->addCompilerPass(new Passes\Events())
            ->addCompilerPass(new Passes\Routes())
            ->addCompilerPass(new Passes\Extendables())
            ->addCompilerPass(new Passes\DashboardComponents())
            ->addCompilerPass(new Passes\Ticket\Widgets())
            ->addCompilerPass(new Passes\Ticket\QuickActionButtons());
    }
}
