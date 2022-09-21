<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;


class AuthenticationHandler implements AuthenticationSuccessHandlerInterface
{
    protected $router;
    private $security;
    public function __construct(Security $security, UrlGeneratorInterface $router)
    {
        $this->security = $security;
        $this->router = $router;

    }

    /**
     * @return RedirectResponse
     * */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        if ($this->security->isGranted('ROLE_USER')) {
            $url = $this->router->generate('sonata_admin_dashboard');
            return new RedirectResponse($url);
        }
    }
}
