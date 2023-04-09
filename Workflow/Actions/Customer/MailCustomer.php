<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Workflow\Actions\Customer;

use Harryn\Jacobn\CoreFrameworkBundle\Entity as CoreEntities;
use Harryn\Jacobn\AutomationBundle\Workflow\FunctionalGroup;
use Harryn\Jacobn\CoreFrameworkBundle\Entity\Ticket;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Harryn\Jacobn\AutomationBundle\Workflow\Action as WorkflowAction;
use Harryn\Jacobn\CoreFrameworkBundle\Entity\EmailTemplates;

class MailCustomer extends WorkflowAction
{
    public static function getId()
    {
        return 'jacobn.customer.mail_customer';
    }

    public static function getDescription()
    {
        return "Mail to customer";
    }

    public static function getFunctionalGroup()
    {
        return FunctionalGroup::CUSTOMER;
    }
    
    public static function getOptions(ContainerInterface $container)
    {
        $entityManager = $container->get('doctrine.orm.entity_manager');

        return array_map(function ($emailTemplate) {
            return [
                'id' => $emailTemplate->getId(),
                'name' => $emailTemplate->getName(),
            ];
        }, $entityManager->getRepository(EmailTemplates::class)->findAll());
    }

    public static function applyAction(ContainerInterface $container, $entity, $value = null)
    {
        $entityManager = $container->get('doctrine.orm.entity_manager');

        switch (true) {
            // Customer created
            case $entity instanceof CoreEntities\User:
                $emailTemplate = $entityManager->getRepository(EmailTemplates::class)->findOneById($value);

                if (empty($emailTemplate)) {
                    // @TODO: Send default email template
                    return;
                }

                $emailPlaceholders = $container->get('email.service')->getEmailPlaceholderValues($entity, 'customer');
                $subject = $container->get('email.service')->processEmailSubject($emailTemplate->getSubject(), $emailPlaceholders);
                $message = $container->get('email.service')->processEmailContent($emailTemplate->getMessage(), $emailPlaceholders);
                
                $messageId = $container->get('email.service')->sendMail($subject, $message, $entity->getEmail());

                break;
            default:
                break;
        }
    }
}
