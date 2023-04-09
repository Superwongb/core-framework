<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Workflow\Events\Ticket;

use Harryn\Jacobn\AutomationBundle\Workflow\FunctionalGroup;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Harryn\Jacobn\AutomationBundle\Workflow\Event as WorkflowEvent;

class Note extends WorkflowEvent
{
    public static function getId()
    {
        return 'jacobn.ticket.note_added';
    }

    public static function getDescription()
    {
        return "Note Added";
    }
    public static function getFunctionalGroup()
    {
        return FunctionalGroup::TICKET;
    }
}
