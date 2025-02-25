<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\DependencyInjection\Passes;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Harryn\Jacobn\CoreFrameworkBundle\Definition\RouteLoader;
use Harryn\Jacobn\CoreFrameworkBundle\Definition\RoutingResourceInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class Routes implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if ($container->has(RouteLoader::class)) {
            $routerDefinition = $container->findDefinition(RouteLoader::class);

            foreach ($container->findTaggedServiceIds(RoutingResourceInterface::class) as $resource => $tags) {
                $routerDefinition->addMethodCall('addRoutingResource', array(new Reference($resource), $tags));
            }
        }
    }
}
