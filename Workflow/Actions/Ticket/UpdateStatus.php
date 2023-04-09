<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Workflow\Actions\Ticket;

use Harryn\Jacobn\CoreFrameworkBundle\Entity\Ticket;
use Harryn\Jacobn\CoreFrameworkBundle\Entity\TicketStatus;
use Harryn\Jacobn\AutomationBundle\Workflow\FunctionalGroup;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Harryn\Jacobn\AutomationBundle\Workflow\Action as WorkflowAction;

class UpdateStatus extends WorkflowAction
{
    public static function getId()
    {
        return 'jacobn.ticket.update_status';
    }

    public static function getDescription()
    {
        return "Set Status As";
    }

    public static function getFunctionalGroup()
    {
        return FunctionalGroup::TICKET;
    }

    public static function getOptions(ContainerInterface $container)
    {
        $entityManager = $container->get('doctrine.orm.entity_manager');

        return array_map(function ($ticketStatus) {
            return [
                'id' => $ticketStatus->getId(),
                'name' => $ticketStatus->getDescription(),
            ];
        }, $entityManager->getRepository(TicketStatus::class)->findAll());
    }

    public static function applyAction(ContainerInterface $container, $entity, $value = null)
    {
        $entityManager = $container->get('doctrine.orm.entity_manager');

        if ($entity instanceof Ticket && !empty($value)) {
            $ticketStatus = $entityManager->getRepository(TicketStatus::class)->findOneById($value);
            $entity->setStatus($ticketStatus);
            $entityManager->persist($entity);
            $entityManager->flush();
        }
    }
}
