<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Workflow\Events\Ticket;

use Harryn\Jacobn\AutomationBundle\Workflow\FunctionalGroup;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Harryn\Jacobn\AutomationBundle\Workflow\Event as WorkflowEvent;

class Priority extends WorkflowEvent
{
    public static function getId()
    {
        return 'jacobn.ticket.priority_updated';
    }

    public static function getDescription()
    {
        return "Priority Updated";
    }

    public static function getFunctionalGroup()
    {
        return FunctionalGroup::TICKET;
    }
}
