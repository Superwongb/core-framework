<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Workflow\Events\Customer;

use Harryn\Jacobn\AutomationBundle\Workflow\FunctionalGroup;
use Harryn\Jacobn\CoreFrameworkBundle\Workflow\Events\UserForgotPassword as UserForgotPasswordEvent;

class ForgotPassword extends UserForgotPasswordEvent
{
    public static function getDescription()
    {
        return "Customer Forgot Password";
    }

    public static function getFunctionalGroup()
    {
        return FunctionalGroup::CUSTOMER;
    }
}
