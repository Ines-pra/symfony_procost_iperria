<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Routing\Annotation\Route;

class JobController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $em)
    {}

    /** 
     * @Route("/job",name="main_job",methods={"GET"})
     */

    public function job() : Response
    {
        return $this->render('template/list.html.twig',[

            'title' => "Métiers",
        ]);
    }

    /** 
     * @Route("/job_form",name="form_job",methods={"GET"})
     */

    public function add_employees() : Response
    {
        return $this->render('forms/formJob.html.twig',[
            'title' => "Métiers",
        ]);
    }


   

}