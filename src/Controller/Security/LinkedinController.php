<?php

namespace App\Controller\Security;

use App\Repository\UserRepository;
use App\Services\Security\CryptDecrypt;
use Doctrine\Persistence\ManagerRegistry;
use KnpU\OAuth2ClientBundle\Client\ClientRegistry;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class LinkedinController extends AbstractController
{
    #[Route("/connect/linkedin", name: "connect_linkedin_start")]
    public function connectAction(ClientRegistry $clientRegistry)
    {
        // will redirect to linkedin!
        return $clientRegistry
            ->getClient('linkedin') // key used in config/packages/knpu_oauth2_client.yaml
            ->redirect([
                'r_liteprofile', 'r_emailaddress' // the scopes you want to access
            ]);
    }

    #[Route("/connect/linkedin/check", name: "connect_linkedin_check")]
    public function connectCheckAction(
        Request $request,
        ClientRegistry $clientRegistry,
        UserRepository $userRepository,
        ManagerRegistry $doctrine,
        TokenStorageInterface $tokenService,
        Session $session,
        AuthorizationCheckerInterface $authorization)
    {
        /** @var \KnpU\OAuth2ClientBundle\Client\Provider\LinkedInClient $client */
        $client = $clientRegistry->getClient('linkedin');

        try {
            /** @var \League\OAuth2\Client\Provider\LinkedInResourceOwner $user */
            $linkedInUser = $client->fetchUser();

            $user = $userRepository->findOneBy([
                'linkedinId' => $linkedInUser->getId(),
            ]);
            if ($user && $user->getIsActive()) {
                $firewall = 'main';
                $token = new UsernamePasswordToken($user, $user->getPassword(), $user->getRoles());
                $tokenService->setToken($token);
                $session->set('_security_secured_area', serialize($token));
            }

            // do something with all this new power!
            // e.g. $name = $user->getFirstName();
            return $this->redirectToRoute('front');
        } catch (IdentityProviderException $e) {
            // something went wrong!
            // probably you should return the reason to the user
            dump($e->getMessage()); die;
        }
    }
}