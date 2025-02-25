<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\UIComponents\Dashboard\Panel\Items\Productivity;

use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\PanelSidebarItemInterface;
use Harryn\Jacobn\CoreFrameworkBundle\UIComponents\Dashboard\Panel\Sidebars\Productivity;

class Tags implements PanelSidebarItemInterface
{
    public static function getTitle() : string
    {
        return "Tags";
    }

    public static function getRouteName() : string
    {
        return 'helpdesk_member_ticket_tag_collection';
    }

    public static function getSupportedRoutes() : array
    {
        return [];
    }

    public static function getRoles() : array
    {
        return ['ROLE_AGENT_MANAGE_TAG'];
    }

    public static function getSidebarReferenceId() : string
    {
        return Productivity::class;
    }
}
