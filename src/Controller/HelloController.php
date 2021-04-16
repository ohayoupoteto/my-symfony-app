<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController{
    /** 
     * @Route("/hello", name="hello")
     */
    public function index(){
        $result = <<< EOM
        <ul>
          <li>牛タン</li>
          <li>ずんだ</li>
          <li>笹かま</li>
        </ul>
EOM;
        return new Response($result);
    }
}
