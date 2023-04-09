<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\DependencyInjection\Passes\Ticket;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Harryn\Jacobn\CoreFrameworkBundle\Tickets\WidgetInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Tickets\WidgetCollection;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class Widgets implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if ($container->has(WidgetCollection::class)) {
            $ticketWidgetCollectionDefinition = $container->findDefinition(WidgetCollection::class);

            foreach ($container->findTaggedServiceIds(WidgetInterface::class) as $id => $tags) {
                $ticketWidgetCollectionDefinition->addMethodCall('add', array(new Reference($id), $tags));
            }
        }
    }
}
