<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\UIComponents\Dashboard\Homepage\Sections;

use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\HomepageSection;

class Productivity extends HomepageSection
{
    public static function getTitle() : string
    {
        return "Productivity";
    }

    public static function getDescription() : string
    {
        return "Automate your processes by creating set of rules and presets to respond faster to the tickets";
    }

    public static function getRoles() : array
    {
        return [];
    }
}
