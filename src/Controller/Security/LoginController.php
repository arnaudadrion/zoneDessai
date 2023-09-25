<?php

namespace App\Controller\Security;

use App\Entity\User;
use App\Form\RegisterType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/security/login', name: 'app_security_login')]
    public function index(Request $request, AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/index.html.twig', [
            'error' => $error,
            'lastusername' => $lastUsername
        ]);
    }

    #[Route('/security/register', name: 'app_security_register')]
    public function Register(
        Request $request,
        UserRepository $userRepository,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $encoder): Response
    {
        $newUser = new User();
        $form = $this->createForm(RegisterType::class, $newUser);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $emailSubmited = $form->get('email')->getData();

            $isUserExist = $userRepository->findOneBy(['username' => $emailSubmited]);

            if ($isUserExist) {
                $form->get('email')->addError(new FormError('usernameexist'));

                return $this->render('security/register.html.twig', [
                    'form' => $form->createView(),
                ]);
            }

            $encodedPass = $encoder->hashPassword($newUser, $form->get('password')->getData());

            $newUser->setPassword($encodedPass);
            $newUser->setEmail($emailSubmited);
            $newUser->setUsername($emailSubmited);
            $newUser->setRoles(['ROLE_USER']);

            $em->persist($newUser);
            $em->flush();

            return $this->redirectToRoute('front');
        }

        return $this->render('security/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
