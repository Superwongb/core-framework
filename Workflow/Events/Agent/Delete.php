<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Workflow\Events\Agent;

use Harryn\Jacobn\AutomationBundle\Workflow\FunctionalGroup;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Harryn\Jacobn\AutomationBundle\Workflow\Event as WorkflowEvent;

class Delete extends WorkflowEvent
{
    public static function getId()
    {
        return 'jacobn.agent.removed';
    }

    public static function getDescription()
    {
        return "Agent Deleted";
    }

    public static function getFunctionalGroup()
    {
        return FunctionalGroup::AGENT;
    }
}
