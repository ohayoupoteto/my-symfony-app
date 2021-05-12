<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Form\PersonType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\Validator\Validator\ValidatorInterface;

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
    public function create(Request $request,ValidatorInterface $validator){
        $person=new Person();
        $form=$this->createFormBuilder($person)
        ->add('name',TextType::class)
        ->add('mail',EmailType::class)
        ->add('age',IntegerType::class)
        ->add('save',SubmitType::class)
        ->getForm();

        if($request->getMethod()=='POST'){
            $form->handleRequest($request);
            

            $errors=$validator->validate($person);
            $add=$person->getAge();
            if(count($errors)==0){
                $manager=$this->getDoctrine()->getManager();
                $manager->persist($person);
                $manager->flush();
                return $this->redirect('/getPersonData');
            }
            else{
                return $this->render('crud/create.html.twig',[
                    'form'=>$form->createView(),
                    'title'=>'createしたいけどエラー',
                    'add'=>$add,
                ]);
            }
        }
        else{
            $add=null;
            return $this->render('crud/create.html.twig',[
                'form'=>$form->createView(),
                'title'=>'createする',
                'add'=>$add,
            ]);
        }
    }

/**
 * @Route("/update/{id}",name="update")
 */
public function update(Request $request,Person $person){

    $form=$this->createForm(PersonType::class,$person);
   
    if($request->getMethod()=='POST'){
        $form->handleRequest($request);
        $person=$form->getData();//無くても一応更新できた
        $manager=$this->getDoctrine()->getManager();
        $manager->flush();
        return $this->redirect('/getPersonData');
    }
    else{
        return $this->render('crud/create.html.twig',[
            'form'=>$form->createView(),
            'title'=>'updateする',
        ]);
    }
}

/**
 * @Route("/delete/{id}",name="delete")
 */
public function delete(Request $request,Person $person){
    $form=$this->createForm(PersonType::class,$person);

    if($request->getMethod()=='POST'){
        $form->handleRequest($request);
        //$person=$form->getData();
        $manager=$this->getDoctrine()->getManager();
        $manager->remove($person);
        $manager->flush();
        return $this->redirect('/getPersonData');
    }
    else{
        return $this->render('crud/create.html.twig',[
            'form'=>$form->createView(),
            'title'=>'deleteする',
        ]);
    }
}

}
