<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\DependencyInjection\Passes;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Dashboard;
use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\AsideTemplate;
use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\SearchTemplate;
use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\SearchItemInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\NavigationInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\PanelSidebarInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\PanelSidebarItemInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\HomepageSectionInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\HomepageSectionItemInterface;

class DashboardComponents implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if ($container->has(Dashboard::class)) {
            $dashboardDefinition = $container->findDefinition(Dashboard::class);

            // Navigation Panel Items
            foreach ($container->findTaggedServiceIds(NavigationInterface::class) as $reference => $tags) {
                $dashboardDefinition->addMethodCall('appendNavigation', array(new Reference($reference)));
            }

            // Homepage Panel Sections
            foreach ($container->findTaggedServiceIds(HomepageSectionInterface::class) as $reference => $tags) {
                $dashboardDefinition->addMethodCall('appendHomepageSection', array(new Reference($reference)));
            }

            // Homepage Panel Section Items
            foreach ($container->findTaggedServiceIds(HomepageSectionItemInterface::class) as $reference => $tags) {
                $dashboardDefinition->addMethodCall('appendHomepageSectionItem', array(new Reference($reference)));
            }
        }

        if ($container->has(AsideTemplate::class)) {
            $panelSidebarTemplateDefinition = $container->findDefinition(AsideTemplate::class);

            // Dashboard Panel Sidebars
            foreach ($container->findTaggedServiceIds(PanelSidebarInterface::class) as $reference => $tags) {
                $panelSidebarTemplateDefinition->addMethodCall('addPanelSidebar', array(new Reference($reference)));
            }

            // Homepage Panel Sidebar Items
            foreach ($container->findTaggedServiceIds(PanelSidebarItemInterface::class) as $reference => $tags) {
                $panelSidebarTemplateDefinition->addMethodCall('addPanelSidebarItem', array(new Reference($reference)));
            }
        }

        if ($container->has(SearchTemplate::class)) {
            $searchTemplateDefinition = $container->findDefinition(SearchTemplate::class);

            // Dashboard Search Items
            foreach ($container->findTaggedServiceIds(SearchItemInterface::class) as $reference => $tags) {
                $searchTemplateDefinition->addMethodCall('appendSearchItem', array(new Reference($reference)));
            }
        }
    }
}
