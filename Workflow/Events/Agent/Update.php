<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Workflow\Events\Agent;

use Harryn\Jacobn\AutomationBundle\Workflow\FunctionalGroup;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Harryn\Jacobn\AutomationBundle\Workflow\Event as WorkflowEvent;

class Update extends WorkflowEvent
{
    public static function getId()
    {
        return 'jacobn.agent.update';
    }

    public static function getDescription()
    {
        return "Agent Update";
    }

    public static function getFunctionalGroup()
    {
        return FunctionalGroup::AGENT;
    }
}
