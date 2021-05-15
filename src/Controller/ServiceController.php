<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\MyService;

class ServiceController extends AbstractController
{
    /**
     * @Route("/service", name="service")
     */
    public function index(MyService $service): Response
    {
        return $this->render('service/index.html.twig',[
            'message'=> $service->getMessage(),
        ]);
    }
}
