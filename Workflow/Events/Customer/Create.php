<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Workflow\Events\Customer;

use Harryn\Jacobn\AutomationBundle\Workflow\FunctionalGroup;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Harryn\Jacobn\AutomationBundle\Workflow\Event as WorkflowEvent;

class Create extends WorkflowEvent
{
    public static function getId()
    {
        return 'jacobn.customer.created';
    }

    public static function getDescription()
    {
        return 'Customer Created';
    }

    public static function getFunctionalGroup()
    {
        return FunctionalGroup::CUSTOMER;
    }
}
