<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Definition;

interface RoutingResourceInterface
{
    CONST YAML_RESOURCE = 'yaml';

    public static function getResourcePath();
    public static function getResourceType();
}
