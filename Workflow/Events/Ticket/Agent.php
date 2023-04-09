<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Workflow\Events\Ticket;

use Harryn\Jacobn\AutomationBundle\Workflow\FunctionalGroup;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Harryn\Jacobn\AutomationBundle\Workflow\Event as WorkflowEvent;

class Agent extends WorkflowEvent
{
    public static function getId()
    {
        return 'jacobn.ticket.agent_updated';
    }

    public static function getDescription()
    {
        return "Agent Updated";
    }

    public static function getFunctionalGroup()
    {
        return FunctionalGroup::TICKET;
    }
}
