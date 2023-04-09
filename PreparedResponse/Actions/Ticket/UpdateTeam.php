<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\PreparedResponse\Actions\Ticket;

use Harryn\Jacobn\AutomationBundle\PreparedResponse\FunctionalGroup;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Entity\Ticket;
use Harryn\Jacobn\AutomationBundle\PreparedResponse\Action as PreparedResponseAction;
use Harryn\Jacobn\CoreFrameworkBundle\Entity\SupportTeam;

class UpdateTeam extends PreparedResponseAction
{
    public static function getId()
    {
        return 'jacobn.ticket.assign_team';
    }

    public static function getDescription()
    {
        return "Assign to team";
    }

    public static function getFunctionalGroup()
    {
        return FunctionalGroup::TICKET;
    }

    public static function getOptions(ContainerInterface $container)
    {
        return $container->get('user.service')->getSupportTeams();
    }

    public static function applyAction(ContainerInterface $container, $entity, $value = null)
    {
        $entityManager = $container->get('doctrine.orm.entity_manager');
        if($entity instanceof Ticket) {
            $subGroup = $entityManager->getRepository(SupportTeam::class)->find($value);
            if($subGroup) {
                $entity->setSupportTeam($subGroup);
                $entityManager->persist($entity);
                $entityManager->flush();
            } else {
                // User Sub Group Not Found. Disable Workflow/Prepared Response
                //$this->disableEvent($event, $entity);
            }
        }
    }
}
