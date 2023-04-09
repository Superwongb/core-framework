<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\UIComponents\Dashboard\Panel\Sidebars;

use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\PanelSidebarInterface;

class Apps implements PanelSidebarInterface
{
    public static function getTitle() : string
    {
        return "Apps";
    }
}