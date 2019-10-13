<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     * @param Request $request
     * @return Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {

        $form = $this->createForm(UserType::class);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            //Expecting a user object
            $data = $form->getData();
            dump($data);
            $user = new User();
            $user->setUsername($data->getUsername());
            $user->setPassword(
                $passwordEncoder->encodePassword($user, $data->getUsername() )
            );

            $entityMgr = $this->getDoctrine()->getManager();
            $entityMgr->persist($user);
            $entityMgr->flush();

            return $this->redirect($this->generateUrl('app_login'));
        }

        return $this->render('registration/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
