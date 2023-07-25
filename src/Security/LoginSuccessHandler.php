<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\HttpUtils;

class LoginSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    private $httpUtils;

    public function __construct(HttpUtils $httpUtils)
    {
        $this->httpUtils = $httpUtils;
    }

     /**
     * Gère la redirection après une authentification réussie.
     *
     * @param Request        $request La requête HTTP.
     * @param TokenInterface $token   Le jeton d'authentification.
     *
     * @return Response
     */

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): Response
    {
        // Après une authentification réussie, redirige l'utilisateur vers la route souhaitée.
        return $this->httpUtils->createRedirectResponse($request, 'app_user_show');
    }
}
