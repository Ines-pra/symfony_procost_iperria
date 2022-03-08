<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $em)
    {}

    /** 
     * @Route("/project",name="main_project",methods={"GET"})
     */

    public function project() : Response
    {
        return $this->render('template/list.html.twig',[

            'title' => "Projets",
        ]);
    }

    /** 
     * @Route("/project_details",name="details_project",methods={"GET"})
     */

    public function details_project() : Response
    {
        return $this->render('details/detailProject.html.twig',[
            'title' => "Projets",
        ]);
    }

    /** 
     * @Route("/project_form",name="form_project",methods={"GET"})
     */

    public function add_project() : Response
    {
        return $this->render('forms/formProject.html.twig',[
            'title' => "Projets",
        ]);
    }


   

}
