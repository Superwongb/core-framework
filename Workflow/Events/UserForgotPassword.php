<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Workflow\Events;

use Harryn\Jacobn\AutomationBundle\Workflow\FunctionalGroup;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Harryn\Jacobn\AutomationBundle\Workflow\Event as WorkflowEvent;

class UserForgotPassword extends WorkflowEvent
{
    public static function getId()
    {
        return 'jacobn.user.forgot_password';
    }

    public static function getDescription()
    {
        return "User Forgot Password";
    }

    public static function getFunctionalGroup()
    {
        return FunctionalGroup::USER;
    }
}
