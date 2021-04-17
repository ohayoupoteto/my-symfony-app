<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class HelloController extends AbstractController{
    /** 
     * @Route("/hello", name="hello")
     */
    public function index(Request $request){
        $name = $request->get("name");
        $name2 = $request->get("name2");
        $result = <<< EOM
        <ul>
          <li>{$name}</li>
          <li>{$name2}</li>
        </ul>
EOM;
        //$result = $this->getSubscribedServices();
        return new Response($result);
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
