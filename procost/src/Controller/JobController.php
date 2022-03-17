<?php

namespace App\Controller;

use App\Entity\Job;
use App\Form\JobType;
use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class JobController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $em,
        private JobRepository $jobRepository)
    {}

    /** 
     * @Route("/job",name="main_job",methods={"GET"})
     */

    public function job() : Response
    {
        $jobs = $this->jobRepository->findAll();

        return $this->render('template/list.html.twig',[
            'title' => "Métiers",
            'jobs' => $jobs
        ]);
    }

    /** 
     * @Route("/job_form/{id}/{action}",name="form_job",methods={"GET","POST"}, requirements={"id"="\d+"})
     */

    public function add_employees(Request $request, int $id, string $action) : Response
    {
        $job = new Job;
        $form = $this->createForm(JobType::class, $job);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            if (($id == 0)&&($action='add')){
                $job1 = new Job();
                $job1->setName($_POST['job']['name']);
                $this->em->persist($job1);
                $this->em->flush();
                $this->addFlash('success', 'Votre ajout a été pris en compte');}
            else {
                $job1 = $this->jobRepository->find($id);
                $job1->setName($_POST['job']['name']);
                $this->em->flush();
                $this->addFlash('success', 'Votre modification a été prise en compte');}
            // return $this->redirectToRoute('/job');
        }

        $job = $this->jobRepository->find($id);

        return $this->render('forms/formJob.html.twig',[
            'title' => "Métiers",
            'form' => $form->createView(),
            'action' => $action,
            'job' => $job
        ]);
    }


   

}