<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request,UserPasswordEncoderInterface $passwordEncoder){
        $user=new User();
        $form=$this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        
        if($request->getMethod()=='POST'){
            if($form->isValid()){
                $password=$passwordEncoder->encodePassword($user,$user->getPassword);
                $user->setPassword($password);
                $manager=$this->getDoctrine()->getManager();
                $manager->persist($user);
                $manager->flush();
                return $this->redirectToRoute('login');
            }
        }
        return $this->render('/register/register.html.twig',[
            'form'=>$form->createView(),
        ]);
    }
}
