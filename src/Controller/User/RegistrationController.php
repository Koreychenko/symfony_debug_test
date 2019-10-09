<?php

namespace App\Controller\User;

use App\Service\UserManager;
use App\Entity\User;
use App\Form\User\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request, UserManager $userManager)
    {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        if ($request->isMethod(Request::METHOD_POST)) {
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                // set confirmation token
                $userManager->updatePassword($user);

                // persist customer and user
                $om = $this->getDoctrine()->getManager();
                $om->persist($user);
                $om->flush();

                // authenticate created user
                $token = new UsernamePasswordToken($user, $user->getPassword(), 'app_user_provider', $user->getRoles());
                $this->container->get('security.token_storage')->setToken($token);
                $this->container->get('session')->set(User::FIRST_LOGIN_FLAG, true);

                // redirect to thanks page
                return $this->redirectToRoute('app_homepage');
            }
        }

        return $this->render('user/registration.html.twig', ['form' => $form->createView()]);
    }
}
