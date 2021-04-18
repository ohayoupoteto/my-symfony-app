<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class HelloController extends AbstractController{
    /** 
     * @Route("/hello", name="hello")
     */
    public function index(Request $request){
        $form=$this->createFormBuilder()
        ->add("input",TextType::class)
        ->add("save",SubmitType::class,["label"=>"click"])
        ->getForm();
        
        if($request->getMethod()=="POST"){
            $form->handleRequest($request);
            $msg="{$form->get("input")->getData()}さんですね";
        }
        else{
            $msg="名前を教えて";
        }

        return $this->render("hello/index.html.twig",[
            "title"=>"名前を聞くやつ",
            "name"=>$msg,
            "form"=>$form->createView()
        ]);
    }

    /**
     * @Route("/other/{domain}",name="other")
     */
    public function other(Request $request ,$domain=""){
        if($domain==""){
            return $this->redirect("/hello");
        }
        else{
            return new RedirectResponse("http://{$domain}.com");
        }
    }
}
