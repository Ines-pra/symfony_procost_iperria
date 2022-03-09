<?php

namespace App\Controller;

use App\Entity\Job;
use App\Form\JobType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/job_form",name="form_job",methods={"GET","POST"})
     */

    public function add_employees(Request $request) : Response
    {

        $job = new Job;
        $form = $this->createForm(JobType::class, $job);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->addFlash('success', 'Votre ajout a été pris en compte');
            // return $this->redirectToRoute('/job');
        }


        return $this->render('forms/formJob.html.twig',[
            'title' => "Métiers",
            'form' => $form->createView()
        ]);
    }


   

}