<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Person;

class CrudController extends AbstractController
{
    
/**
 * @Route("/create",name="create")
 */
    public function create(Request $request){
        $person=new Person();
        $form=$this->createFormBuilder($person)
        ->add('name',TextType::class)
        ->add('mail',EmailType::class)
        ->add('age',IntegerType::class)
        ->add('save',SubmitType::class)
        ->getForm();

        if($request->getMethod()=='POST'){
            $form->handleRequest($request);
            $person=$form->getData();
            $manager=$this->getDoctrine()->getManager();
            $manager->persist($person);
            $manager->flush();
            return $this->redirect('/getPersonData');
        }
        else{
            return $this->render('crud/create.html.twig',[
                'form'=>$form->createView(),
                'title'=>'createする',
            ]);
        }

}
}
