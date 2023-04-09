<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\UIComponents\Dashboard\Panel\Sidebars;

use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\PanelSidebarInterface;

class Branding implements PanelSidebarInterface
{
    public static function getTitle() : string
    {
        return "Branding";
    }
}
