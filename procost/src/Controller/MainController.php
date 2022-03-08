<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

class MainController extends AbstractController 
{

    public function __construct(
        private EntityManagerInterface $em, )
    {
    }   

    /** 
     * @Route("/",name="main_homepage",methods={"GET"})
     */

    public function main() : Response
    {
        return $this->render('template/index.html.twig',[
            'title' => "Homepage",
        ]);
    }

}