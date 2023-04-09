<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Guides;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class BootstrappingProject extends Command
{
    private static $console_guide_resource = __DIR__ . "/../Templates/CLI/Guides";

    protected function configure()
    {
        $this->setName('jacobn:guides:bootstrapping-project');
        $this->setDescription('Walks you through on how to provide the minimal setup for your support system.');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $consoleOutputText = require self::$console_guide_resource . "/jacobn-bootstrapping-guide.php";
        
        $output->writeln($consoleOutputText);
    }
}
