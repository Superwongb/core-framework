<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\UIComponents\Dashboard\Panel\Items\Productivity;

use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\PanelSidebarItemInterface;
use Harryn\Jacobn\CoreFrameworkBundle\UIComponents\Dashboard\Panel\Sidebars\Productivity;

class SavedReplies implements PanelSidebarItemInterface
{
    public static function getTitle() : string
    {
        return "Saved Replies";
    }

    public static function getRouteName() : string
    {
        return 'helpdesk_member_saved_replies';
    }

    public static function getSupportedRoutes() : array
    {
        return [
            'helpdesk_member_saved_replies', 
            'helpdesk_member_update_saved_replies',
            'helpdesk_member_create_saved_replies',
        ];
    }

    public static function getRoles() : array
    {
        return [];
    }

    public static function getSidebarReferenceId() : string
    {
        return Productivity::class;
    }
}
