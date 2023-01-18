<?php

declare(strict_types=1);

namespace DevBase\Bundle\UserBundle\Security;

use DevBase\Bundle\UserBundle\Entity\User;
use Symfony\Component\Security\Core\Exception\DisabledException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    /**
     * @return void
     */
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof User) {
            return;
        }

        if (!$user->isEnabled()) {
            $exception = new DisabledException('DISABLED');
            if ( $user instanceof User && $user->getConfirmationToken() ) {
                $exception = new DisabledException('DISABLED:' . Strings::base64EncodeUrl($user->getEmail()));
            }

            $exception->setUser($user);
            throw $exception;
        }

        if (!$user->isEnabled()) {
            $exception = new DisabledException('Your account has been disabled by an administrator');
            $exception->setUser($user);
            throw $exception;
        }
    }

    /**
     * @return void
     */
        public function checkPostAuth(UserInterface $user)
    {
    }
}
