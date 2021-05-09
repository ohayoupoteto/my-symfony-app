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
        $form=$this->createForm(FlashType::class,null);
        if($request->getMethod()=='POST'){
            $form->handleRequest($request);
            $datas=$form->getData()['mail'];
            $this->addFlash('info.mail','ようこそ、'.$datas.'さん');
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
