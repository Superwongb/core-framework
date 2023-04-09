<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Fixtures;

use Doctrine\Persistence\ObjectManager;
use Harryn\Jacobn\CoreFrameworkBundle\Entity as CoreEntities;
use Doctrine\Bundle\FixturesBundle\Fixture as DoctrineFixture;
use Harryn\Jacobn\CoreFrameworkBundle\Entity\SupportPrivilege;

class AgentPrivileges extends DoctrineFixture
{
    private static $seeds = [
        [
            'name' => 'Default Privileges',
            'description' => 'Default Privileges',
            'privileges' => [
                'ROLE_AGENT_ADD_NOTE'
            ],
        ],
    ];

    public function load(ObjectManager $entityManager)
    {
        $availableSupportPrivileges = $entityManager->getRepository(SupportPrivilege::class)->findAll();

        if (empty($availableSupportPrivileges)) {
            foreach (self::$seeds as $supportPrivilegeSeed) {
                $supportPrivilege = new CoreEntities\SupportPrivilege();
                $supportPrivilege->setName($supportPrivilegeSeed['name']);
                $supportPrivilege->setDescription($supportPrivilegeSeed['description']);
                $supportPrivilege->setPrivileges($supportPrivilegeSeed['privileges']);
                $supportPrivilege->setCreatedAt(new \Datetime('now'));

                $entityManager->persist($supportPrivilege);
            }
    
            $entityManager->flush();
        }
    }
}
