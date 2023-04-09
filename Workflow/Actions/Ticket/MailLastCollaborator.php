<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Workflow\Actions\Ticket;

use Harryn\Jacobn\AutomationBundle\Workflow\FunctionalGroup;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Entity\Ticket;
use Harryn\Jacobn\AutomationBundle\Workflow\Action as WorkflowAction;
use Harryn\Jacobn\CoreFrameworkBundle\Entity\EmailTemplates;

class MailLastCollaborator extends WorkflowAction
{
    public static function getId()
    {
        return 'jacobn.ticket.mail_last_collaborator';
    }

    public static function getDescription()
    {
        return "Mail to last collaborator";
    }

    public static function getFunctionalGroup()
    {
        return FunctionalGroup::TICKET;
    }

    public static function getOptions(ContainerInterface $container)
    {
        $entityManager = $container->get('doctrine.orm.entity_manager');

        $emailTemplateCollection = array_map(function ($emailTemplate) {
            return [
                'id' => $emailTemplate->getId(),
                'name' => $emailTemplate->getName(),
            ];
        }, $entityManager->getRepository(EmailTemplates::class)->findAll());

        return $emailTemplateCollection;
    }

    public static function applyAction(ContainerInterface $container, $entity, $value = null)
    {
        $entityManager = $container->get('doctrine.orm.entity_manager');
        if($entity instanceof Ticket) {
            $emailTemplate = $entityManager->getRepository(EmailTemplates::class)->findOneById($value);
            if(count($entity->getCollaborators()) && $emailTemplate) {
                $mailData = array();
                $createThread = $container->get('ticket.service')->getCreateReply($entity->getId(),false);
                $mailData['references'] = $createThread['messageId'];
                
                if(!isset($entity->lastCollaborator)) {
                    try {
                        $entity->lastCollaborator = $entity->getCollaborators()[ -1 + count($entity->getCollaborators()) ];
                    } catch(\Exception $e) {
                    }
                }
                if($entity->lastCollaborator) {
                    $placeHolderValues   = $container->get('email.service')->getTicketPlaceholderValues($entity);
                    $subject = $container->get('email.service')->processEmailSubject($emailTemplate->getSubject(),$placeHolderValues);
                    $message = $container->get('email.service')->processEmailContent($emailTemplate->getMessage(),$placeHolderValues);
                    $email   = $entity->lastCollaborator->getEmail();
                    $messageId = $container->get('email.service')->sendMail($subject, $message, $email, $mailData);
                }
            }
        }
    }
}
