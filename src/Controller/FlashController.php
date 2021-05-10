<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Form\FlashType;

class FlashController extends AbstractController
{
    /**
     * @Route("/flash", name="flash")
     */
    public function index(Request $request){
        $formobj=new FlashForm();
        /* $formobj->setName('池田');
        $formobj->setMail('unko@gmail.com'); */
        $form=$this->createForm(FlashType::class,$formobj);
        if($request->getMethod()=='POST'){
            $form->handleRequest($request);
            $datas=$form->getData();
            $this->addFlash('info-mail',$datas);
            $msg=null;
        }
        else{
            $msg='フォームに入力してください';
            $datas=null;
        }
        return $this->render('flash/index.html.twig',[
            'form'=>$form->createView(),
            'msg'=>$msg,
            'datas'=>$datas,
        ]);
    }
    
}

class FlashForm{
    private $name;
    private $mail;

    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name=$name;
    }
    public function getMail(){
        return $this->mail;
    }
    public function setMail($mail){
        $this->mail=$mail;
    }

    public function __toString(){
        return $this->getMail();
    }
}
