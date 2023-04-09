<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Workflow\Events\Agent;

use Harryn\Jacobn\AutomationBundle\Workflow\FunctionalGroup;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Harryn\Jacobn\AutomationBundle\Workflow\Event as WorkflowEvent;

class Create extends WorkflowEvent
{
    public static function getId()
    {
        return 'jacobn.agent.created';
    }

    public static function getDescription()
    {
        return "Agent Created";
    }

    public static function getFunctionalGroup()
    {
        return FunctionalGroup::AGENT;
    }
}
