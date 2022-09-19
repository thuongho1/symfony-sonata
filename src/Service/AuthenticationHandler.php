<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;

class AuthenticationHandler implements AuthenticationSuccessHandlerInterface
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * @return RedirectResponse
     * */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $user = $token->getUser();
        if ($user->hasRole('ROLE_USER') || $user->hasRole('ROLE_SUPER_ADMIN')) {
            $url = $this->container->get('router')->generate('sonata_admin_dashboard');
        }

        return new RedirectResponse($url);

    }
}
