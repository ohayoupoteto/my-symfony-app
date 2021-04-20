<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
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
        $array1 = [
            'name1' => 'unko',
            'name2' => 'sikko',
            'name3' => 'pikko'
        ];
        $array2 = [
            'name1' => 'unko',
            'name2' => 'sikko',
            'name3' => 'pikko'
        ];
        $array3 = [
            'name1' => 'unko',
            'name2' => 'sikko',
            'name3' => 'pikko'
        ];
        return $this->render("hello/index.html.twig",[
            "title"=>"名前を聞くやつ",
            "name"=>$msg,
            'message'=>'これはサンプルページです',
            'array'=> [$array1,$array2,$array3],
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

    /**
     * @Route("/form2",name="form2")
     */
    public function form2(Request $request){
        $person = new Person("taro",36,"taro@yamada.com");

        $form = $this->createFormBuilder($person)
          ->add("name",TextType::class)
          ->add("age",IntegerType::class)
          ->add("email",EmailType::class)
          ->add("save",SubmitType::class,["label"=>"Click"])
          ->getForm();

        if($request->getMethod()=="POST"){
            $form->handleRequest($request);
            $obj=$form->getData();
            $msg= <<< EOM
            <ul>
            <li>{$obj->getName()}</li>
            <li>{$obj->getAge()}</li>
            <li>{$obj->getEmail()}</li>
            </ul>
EOM;
        }
        else{
            $msg="名前を書いてね";
        }
       
        return $this->render("hello/form2.html.twig",[
            "message"=>$msg,
            "form"=>$form->createView(),
        ]);
    }

    /**
     * @Route("/session_test",name="session_test")
     */
    public function session_test(Request $request,SessionInterface $session){
        $data=new MyData();

        $form=$this->createFormBuilder($data)
        ->add("data",TextType::class)
        ->add("save",SubmitType::class,["label"=>"click"])
        ->getForm();

        if($request->getMethod()=="POST"){
            $form->handleRequest($request);
            $obj=$form->getData();
            if($obj->getData()=="!"){
                $session->remove("data");
            }
            else{
                $session->set("data",$obj->getData());
            }
        }

        return $this->render("hello/session_test.html.twig",[
           "data"=>$session->get("data"),
           "form"=>$form->createView(),
        ]);

    }
}

class Person{
    protected $name;
    protected $age;
    protected $email;

    public function __construct($name,$age,$email){
        $this->name=$name;
        $this->age=$age;
        $this->email=$email;
    }
    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name = $name;
    }
    public function getAge(){
        return $this->age;
    }
    public function setAge($age){
        $this->age = $age;
    }
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }
}

class MyData{
    private $data="";

    public function getData(){
        return $this->data;
    }
    public function setData($data){
        $this->data=$data;
    }
}
