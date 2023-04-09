<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\PreparedResponse\Actions\Ticket;

use Harryn\Jacobn\AutomationBundle\PreparedResponse\FunctionalGroup;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Entity\Ticket;
use Harryn\Jacobn\AutomationBundle\PreparedResponse\Action as PreparedResponseAction;
use Harryn\Jacobn\CoreFrameworkBundle\Entity\TicketStatus;

class MarkSpam extends PreparedResponseAction
{
    public static function getId()
    {
        return 'jacobn.ticket.mark_spam';
    }

    public static function getDescription()
    {
        return "Mark Spam";
    }

    public static function getFunctionalGroup()
    {
        return FunctionalGroup::TICKET;
    }

    public static function getOptions(ContainerInterface $container)
    {
        return [];
    }

    public static function applyAction(ContainerInterface $container, $entity, $value = null)
    {
        $entityManager = $container->get('doctrine.orm.entity_manager');
        if($entity instanceof Ticket) {
            $status = $entityManager->getRepository(TicketStatus::class)->find(6);
            $entity->setStatus($status);
            $entityManager->persist($entity);
            $entityManager->flush();
        }
    }
}
