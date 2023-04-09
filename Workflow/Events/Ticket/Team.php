<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Workflow\Events\Ticket;

use Harryn\Jacobn\AutomationBundle\Workflow\FunctionalGroup;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Harryn\Jacobn\AutomationBundle\Workflow\Event as WorkflowEvent;

class Team extends WorkflowEvent
{
    public static function getId()
    {
        return 'jacobn.ticket.team_updated';
    }

    public static function getDescription()
    {
        return 'Team Updated';
    }

    public static function getFunctionalGroup()
    {
        return FunctionalGroup::TICKET;
    }
}
