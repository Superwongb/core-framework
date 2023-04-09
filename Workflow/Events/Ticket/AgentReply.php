<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Workflow\Events\Ticket;

use Harryn\Jacobn\AutomationBundle\Workflow\FunctionalGroup;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Harryn\Jacobn\AutomationBundle\Workflow\Event as WorkflowEvent;

class AgentReply extends WorkflowEvent
{
    public static function getId()
    {
        return 'jacobn.ticket.agent_reply';
    }

    public static function getDescription()
    {
        return "Agent Reply";
    }

    public static function getFunctionalGroup()
    {
        return FunctionalGroup::TICKET;
    }
}
