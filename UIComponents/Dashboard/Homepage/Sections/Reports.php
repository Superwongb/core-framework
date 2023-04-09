<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\UIComponents\Dashboard\Homepage\Sections;

use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\HomepageSection;

class Reports extends HomepageSection
{
    public static function getTitle() : string
    {
        return "Reports";
    }

    public static function getDescription() : string
    {
        return "View analytics and insights to serve a better experience for your customers";
    }

    public static function getRoles() : array
    {
        return [
            'ROLE_AGENT_MANAGE_AGENT_ACTIVITY'
        ];
    }
}
