<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Package;

use Harryn\Jacobn\PackageManager\Composer\ComposerPackage;
use Harryn\Jacobn\PackageManager\Composer\ComposerPackageExtension;

class Composer extends ComposerPackageExtension
{
    public function loadConfiguration()
    {
        $composerPackage = new ComposerPackage();
        $composerPackage
            ->movePackageConfig('config/packages/jacobn.yaml', 'Templates/config.yaml')
            ->movePackageConfig('templates/mail.html.twig', 'Templates/Email/base.html.twig')
            ->movePackageConfig('config/packages/security.yaml', 'Templates/security.yaml')
            ->movePackageConfig('config/packages/doctrine.yaml', 'Templates/doctrine.yaml')
            ->movePackageConfig('config/packages/swiftmailer.yaml', 'Templates/swiftmailer.yaml')
            ->combineProjectConfig('config/packages/twig.yaml', 'Templates/twig.yaml')
            ->writeToConsole(require __DIR__ . "/../Templates/CLI/on-boarding.php");
        
        return $composerPackage;
    }
}
