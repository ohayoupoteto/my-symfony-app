<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils){
        $errors=$authenticationUtils->getLastAuthenticationError();
        if($this->getUser()==null){
            $user_message='誰もログインしていません';
        }
        else{
            $user_message='ログイン中：'.$this->getUser()->getUsername();
        }
        return $this->render('security/login.html.twig',[
            'errors'=>$errors,
            'user_message'=>$user_message,
        ]);
    }
}
