<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Templates\Email;

interface UVDeskEmailTemplateInterface
{
    public static function getName();
    public static function getSubject();
    public static function getMessage();
}