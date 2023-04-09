<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Workflow\Actions\Ticket;

use Harryn\Jacobn\AutomationBundle\Workflow\FunctionalGroup;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Harryn\Jacobn\CoreFrameworkBundle\Entity\Ticket;
use Harryn\Jacobn\AutomationBundle\Workflow\Action as WorkflowAction;
use Harryn\Jacobn\CoreFrameworkBundle\Entity\EmailTemplates;
use Harryn\Jacobn\CoreFrameworkBundle\Entity\Attachment;

class MailTeam extends WorkflowAction
{
    public static function getId()
    {
        return 'jacobn.ticket.mail_team';
    }

    public static function getDescription()
    {
        return "Mail to team";
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

        $supportTeamCollection = array_map(function ($supportTeam) {
            return [
                'id' => $supportTeam['id'],
                'name' => $supportTeam['name'],
            ];
        }, $container->get('user.service')->getSupportTeams());

        array_unshift($supportTeamCollection, [
            'id' => 'assignedTeam',
            'name' => 'Assigned Team',
        ]);

        return [
            'partResults' => $supportTeamCollection,
            'templates' => $emailTemplateCollection,
        ];
    }

    public static function applyAction(ContainerInterface $container, $entity, $value = null)
    {
        $entityManager = $container->get('doctrine.orm.entity_manager');
        $emailTemplate = $entityManager->getRepository(EmailTemplates::class)->findOneById($value['value']);
        if($entity instanceof Ticket && $emailTemplate) {
            $mailData = array();
            if($entity instanceof Ticket) {
                $createThread = $container->get('ticket.service')->getCreateReply($entity->getId(), false);
                $mailData['references'] = $createThread['messageId'];
            }

            $createdThread = isset($entity->createdThread) && $entity->createdThread->getThreadType() != "note" ? $entity->createdThread : (isset($entity->currentThread) ? $entity->currentThread : "") ;
            $attachments = [];
            if (!empty($createdThread) && (strpos($emailTemplate->getMessage(), '{%ticket.attachments%}') !== false || strpos($emailTemplate->getMessage(), '{% ticket.attachments %}') !== false)) {
                $attachments = array_map(function($attachment) use ($container) { 
                    return str_replace('//', '/', $container->get('kernel')->getProjectDir() . "/public" . $attachment->getPath());
                }, $entityManager->getRepository(Attachment::class)->findByThread($createdThread));
            }

            $to = array();
            foreach ($value['for'] as $subGrp) {
                foreach ($container->get('user.service')->getUsersBySubGroupId((($subGrp == 'assignedTeam' && $entity->getSupportTeam()) ? $entity->getSupportTeam()->getId() : $subGrp)) as $agent) {
                    $to[] = $agent['email'];
                }
            }
            if(count($to)) {
                $mailData['email'] = $to;
                $placeHolderValues   = $container->get('email.service')->getTicketPlaceholderValues($entity);
                $subject = $container->get('email.service')->processEmailSubject($emailTemplate->getSubject(),$placeHolderValues);
                $message = $container->get('email.service')->processEmailContent($emailTemplate->getMessage(),$placeHolderValues);

                foreach($mailData['email'] as $email){
                    $messageId = $container->get('email.service')->sendMail($subject, $message, $email, [], null, $attachments ?? []);
                }
            }
        } else {
            if (!$emailTemplate) {
                // Email Template Not Found. Disable Workflow/Prepared Response
                //$this->disableEvent($event, $object);
            }
        }
    }
}
