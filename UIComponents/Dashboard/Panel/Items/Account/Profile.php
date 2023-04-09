<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\UIComponents\Dashboard\Panel\Items\Account;

use Harryn\Jacobn\CoreFrameworkBundle\Dashboard\Segments\PanelSidebarItemInterface;
use Harryn\Jacobn\CoreFrameworkBundle\UIComponents\Dashboard\Panel\Sidebars\Account;

class Profile implements PanelSidebarItemInterface
{
    public static function getTitle() : string
    {
        return "Profile";
    }

    public static function getRouteName() : string
    {
        return 'helpdesk_member_profile';
    }

    public static function getSupportedRoutes() : array
    {
        return [];
    }

    public static function getRoles() : array
    {
        return [];
    }

    public static function getSidebarReferenceId() : string
    {
        return Account::class;
    }
}
