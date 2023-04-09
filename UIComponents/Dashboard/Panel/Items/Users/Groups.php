<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\UIComponents\Dashboard\Panel\Items\Users;

use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\PanelSidebarItemInterface;
use Harryn\Jacobn\CoreFrameworkBundle\UIComponents\Dashboard\Panel\Sidebars\Users;

class Groups implements PanelSidebarItemInterface
{
    public static function getTitle() : string
    {
        return "Groups";
    }

    public static function getRouteName() : string
    {
        return 'helpdesk_member_support_group_collection';
    }

    public static function getSupportedRoutes() : array
    {
        return [
            'helpdesk_member_create_support_group',
            'helpdesk_member_update_support_group',
            'helpdesk_member_support_group_collection', 
        ];
    }

    public static function getRoles() : array
    {
        return ['ROLE_AGENT_MANAGE_GROUP'];
    }

    public static function getSidebarReferenceId() : string
    {
        return Users::class;
    }
}
