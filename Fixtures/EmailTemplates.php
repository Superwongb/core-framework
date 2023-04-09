<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Fixtures;

use Doctrine\Persistence\ObjectManager;
use Harryn\Jacobn\CoreFrameworkBundle\Entity as CoreEntities;
use Doctrine\Bundle\FixturesBundle\Fixture as DoctrineFixture;
use Harryn\Jacobn\CoreFrameworkBundle\Templates\Email\Resources as CoreEmailTemplates;
use Harryn\Jacobn\CoreFrameworkBundle\Entity\EmailTemplates as CoreBundleEmailTemplates;

class EmailTemplates extends DoctrineFixture
{
    private static $seeds = [
        CoreEmailTemplates\UserForgotPassword::class,
        CoreEmailTemplates\Agent\TicketReply::class,
        CoreEmailTemplates\Agent\TicketCreated::class,
        CoreEmailTemplates\Agent\AccountCreated::class,
        CoreEmailTemplates\Agent\TicketAssigned::class,
        CoreEmailTemplates\Customer\TicketReply::class,
        CoreEmailTemplates\Customer\TicketCreated::class,
        CoreEmailTemplates\Customer\AccountCreated::class,
        CoreEmailTemplates\Collaborator\AccountAdded::class,
        CoreEmailTemplates\Collaborator\TicketReplyAgent::class,
        CoreEmailTemplates\Collaborator\TicketReplyCustomer::class,
    ];

    public function load(ObjectManager $entityManager)
    {
        $emailTemplateCollection = $entityManager->getRepository(CoreBundleEmailTemplates::class)->findAll();

        if (empty($emailTemplateCollection)) {
            foreach (self::$seeds as $coreEmailTemplate) {
                ($emailTemplate = new CoreEntities\EmailTemplates())
                    ->setName($coreEmailTemplate::getName())
                    ->setTemplateType($coreEmailTemplate::getTemplateType())
                    ->setSubject($coreEmailTemplate::getSubject())
                    ->setMessage($coreEmailTemplate::getMessage());

                $entityManager->persist($emailTemplate);
            }

            $entityManager->flush();
        }
    }
}
