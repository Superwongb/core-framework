<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Harryn\Jacobn\CoreFrameworkBundle\Definition\RouterInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Definition\RoutingResourceInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Framework\ExtendableComponentInterface;

use Harryn\Jacobn\CoreFrameworkBundle\Tickets\WidgetInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Tickets\QuickActionButtonInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\SearchItemInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\NavigationInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\HomepageSectionInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\HomepageSectionItemInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\PanelSidebarInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\PanelSidebarItemInterface;

class CoreFramework extends Extension
{
    public function getAlias()
    {
        return 'jacobn';
    }

    public function getConfiguration(array $configs, ContainerBuilder $container)
    {
        return new BundleConfiguration();
    }

    public function load(array $configs, ContainerBuilder $container)
    {
        $services = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config/services'));

        $services->load('core.yaml');
        $services->load('public.yaml');

        // Register automations conditionally if AutomationBundle has been added as an dependency.
        if (array_key_exists('UVDeskAutomationBundle', $container->getParameter('kernel.bundles'))) {
            $services->load('automations.yaml');
        }

        // Load bundle configurations
        $configuration = $this->getConfiguration($configs, $container);
        foreach ($this->processConfiguration($configuration, $configs) as $param => $value) {
            switch ($param) {
                case 'support_email':
                case 'upload_manager':
                    foreach ($value as $field => $fieldValue) {
                        $container->setParameter("jacobn.$param.$field", $fieldValue);
                    }
                    break;
                case 'default':
                    foreach ($value as $defaultItem => $defaultItemValue) {
                        switch ($defaultItem) {
                            case 'templates':
                                foreach ($defaultItemValue as $template => $templateValue) {
                                    $container->setParameter("jacobn.default.templates.$template", $templateValue);
                                }
                                break;
                            case 'ticket':
                                foreach ($defaultItemValue as $option => $optionValue) {
                                    $container->setParameter("jacobn.default.ticket.$option", $optionValue);
                                }
                                break;
                            default:
                                $container->setParameter("jacobn.default.$defaultItem", $defaultItemValue);
                                break;
                        }
                    }
                    break;
                default:
                    $container->setParameter("jacobn.$param", $value);
                    break;
            }
        }

        $container->registerForAutoconfiguration(RouterInterface::class)->addTag('routing.loader');
        $container->registerForAutoconfiguration(WidgetInterface::class)->addTag(WidgetInterface::class);
        $container->registerForAutoconfiguration(QuickActionButtonInterface::class)->addTag(QuickActionButtonInterface::class);

        $container->registerForAutoconfiguration(RoutingResourceInterface::class)->addTag(RoutingResourceInterface::class);
        $container->registerForAutoconfiguration(ExtendableComponentInterface::class)->addTag(ExtendableComponentInterface::class);

        // $container->registerForAutoconfiguration(EmbeddableResourceInterface::class)->addTag(EmbeddableResourceInterface::class);

        $container->registerForAutoconfiguration(SearchItemInterface::class)->addTag(SearchItemInterface::class);
        $container->registerForAutoconfiguration(NavigationInterface::class)->addTag(NavigationInterface::class);
        $container->registerForAutoconfiguration(HomepageSectionInterface::class)->addTag(HomepageSectionInterface::class);
        $container->registerForAutoconfiguration(HomepageSectionItemInterface::class)->addTag(HomepageSectionItemInterface::class);
        $container->registerForAutoconfiguration(PanelSidebarInterface::class)->addTag(PanelSidebarInterface::class);
        $container->registerForAutoconfiguration(PanelSidebarItemInterface::class)->addTag(PanelSidebarItemInterface::class);
    }
}
