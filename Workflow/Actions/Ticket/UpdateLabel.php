<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Workflow\Actions\Ticket;

use Harryn\Jacobn\AutomationBundle\Workflow\FunctionalGroup;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Entity\Ticket;
use Harryn\Jacobn\CoreFrameworkBundle\Entity\SupportLabel;
use Harryn\Jacobn\AutomationBundle\Workflow\Action as WorkflowAction;

class UpdateLabel extends WorkflowAction
{
    public static function getId()
    {
        return 'jacobn.ticket.update_label';
    }

    public static function getDescription()
    {
        return "Set Label As";
    }

    public static function getFunctionalGroup()
    {
        return FunctionalGroup::TICKET;
    }

    public static function getOptions(ContainerInterface $container)
    {
        $entityManager = $container->get('doctrine.orm.entity_manager');

        return array_map(function ($label) {
            return [
                'id' => $label->getId(),
                'name' => $label->getName(),
            ];
        }, $container->get('ticket.service')->getUserLabels());
    }

    public static function applyAction(ContainerInterface $container, $entity, $value = null)
    {
        $entityManager = $container->get('doctrine.orm.entity_manager');
        if($entity instanceof Ticket) {
            $isAlreadyAdded = 0;
            $labels = $container->get('ticket.service')->getTicketLabelsAll($entity->getId());
            if(is_array($labels)) {
                foreach ($labels as $label) {
                    if($label['id'] == $value)
                        $isAlreadyAdded = 1;
                }
            }
            if(!$isAlreadyAdded) {
                $label = $entityManager->getRepository(SupportLabel::class)->find($value);
                if($label) {
                    $entity->addSupportLabel($label);
                    $entityManager->persist($entity);
                    $entityManager->flush();
                }
            }
        }
    }
}
