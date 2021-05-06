<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Person;
use App\Entity\Message;

use App\Form\PersonType;
use App\Form\MessageType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\Validator\Validator\ValidatorInterface;

class MessageController extends AbstractController
{
    /**
     * @Route("/message", name="message")
     */
    public function index()
    {
        $repository=$this->getDoctrine()->getRepository(Message::class);
        $messages=$repository->findAll();
        return $this->render('message/index.html.twig',[
            'title'=>'index',
            'messages'=>$messages,
        ]);
    }

    /**
     * @Route("/message/create",name="message/create")
     */
    public function create(Request $request,ValidatorInterface $validator){
        $message=new Message();
        $form=$this->createForm(MessageType::class,$message);

        if($request->getMethod()=='POST'){
            $form->handleRequest($request);
            $new_message=$form->getData();
            $validate_errors=$validator->validate($message);

            if(count($validate_errors)==0){
                $manager=$this->getDoctrine()->getManager();
                $manager->persist($new_message);
                $manager->flush();
                return $this->redirect('/message');
            }
            else{
                $msg='投稿できませんでした';
            }
        }
        else{
            $msg='さあ投稿してみよう';
        }
        return $this->render('message/create.html.twig',[
            'title'=>'create',
            'msg'=>$msg,
            'form'=>$form->createView(),
        ]);
        

    }
}
