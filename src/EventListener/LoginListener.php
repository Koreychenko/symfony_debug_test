<?php


namespace App\EventListener;

use App\Entity\User;
use App\Service\UserManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class LoginListener
{
    private $em;
    private $userManager;

    public function __construct(EntityManagerInterface $em, UserManager $userManager)
    {
        $this->em = $em;
        $this->userManager = $userManager;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        /**
         * @var User $user
         */
        $user = $event->getAuthenticationToken()->getUser();

        $this->userManager->updateLastLogin($user);
        $this->userManager->saveUser($user);
    }
}