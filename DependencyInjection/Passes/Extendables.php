<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\DependencyInjection\Passes;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Harryn\Jacobn\CoreFrameworkBundle\Framework\ExtendableComponentManager;
use Harryn\Jacobn\CoreFrameworkBundle\Framework\ExtendableComponentInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class Extendables implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if ($container->has(ExtendableComponentManager::class)) {
            $extendableComponentManagerDefinition = $container->findDefinition(ExtendableComponentManager::class);

            foreach ($container->findTaggedServiceIds(ExtendableComponentInterface::class) as $component => $tags) {
                $extendableComponentManagerDefinition->addMethodCall('addComponent', array(new Reference($component)));
            }
        }
    }
}
