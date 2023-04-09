<?php

namespace Harryn\Jacobn\CoreFrameworkBundle\Controller;

use Symfony\Component\Yaml\Yaml;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Harryn\Jacobn\CoreFrameworkBundle\Services\UserService;
use Symfony\Contracts\Translation\TranslatorInterface;
use Harryn\Jacobn\CoreFrameworkBundle\SwiftMailer\SwiftMailer;

class EmailSettings extends AbstractController
{
    private $userService;
    private $translator;
    private $swiftMailer;

    public function __construct(UserService $userService, TranslatorInterface $translator,SwiftMailer $swiftMailer)
    {
        $this->userService = $userService;
        $this->translator = $translator;
        $this->swiftMailer = $swiftMailer;
    }

    public function loadSettings()
    {
        if (!$this->userService->isAccessAuthorized('ROLE_ADMIN')) {
            throw new AccessDeniedException("Insufficient account privileges");
        }

        $swiftmailerConfigurations = array_map(function ($configuartion) {
            return $configuartion->getId();
        }, $this->swiftMailer->parseSwiftMailerConfigurations());

        return $this->render('@UVDeskCoreFramework//Email//emailSettings.html.twig', [
            'swiftmailers' => $swiftmailerConfigurations,
            'email_settings' => [
                'id' => $this->getParameter('jacobn.support_email.id'),
                'name' => $this->getParameter('jacobn.support_email.name'),
                'mailer_id' => $this->getParameter('jacobn.support_email.mailer_id')
            ],
        ]);
    }
}
