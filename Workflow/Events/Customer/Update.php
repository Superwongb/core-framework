<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Workflow\Events\Customer;

use Harryn\Jacobn\AutomationBundle\Workflow\FunctionalGroup;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Harryn\Jacobn\AutomationBundle\Workflow\Event as WorkflowEvent;

class Update extends WorkflowEvent
{
    public static function getId()
    {
        return 'jacobn.customer.updated';
    }

    public static function getDescription()
    {
        return "Customer Update";
    }

    public static function getFunctionalGroup()
    {
        return FunctionalGroup::CUSTOMER;
    }
}
