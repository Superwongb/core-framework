<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Workflow\Events\Ticket;

use Harryn\Jacobn\AutomationBundle\Workflow\FunctionalGroup;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Harryn\Jacobn\AutomationBundle\Workflow\Event as WorkflowEvent;

class CustomerReply extends WorkflowEvent
{
    public static function getId()
    {
        return 'jacobn.ticket.customer_reply';
    }

    public static function getDescription()
    {
        return "Customer Reply";
    }

    public static function getFunctionalGroup()
    {
        return FunctionalGroup::TICKET;
    }
}
