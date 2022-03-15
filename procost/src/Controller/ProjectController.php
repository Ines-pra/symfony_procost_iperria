<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use App\Repository\TimeProjectRepository;

class ProjectController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $em,
        private ProjectRepository $projectRepository,
        private TimeProjectRepository $timeProjectRepository)
    {}

    /** 
     * @Route("/project",name="main_project",methods={"GET"})
     */

    public function project() : Response
    {
        $projects = $this->projectRepository->findAll();

        return $this->render('template/list.html.twig',[
            'title' => "Projets",
            'projects' => $projects
        ]);
    }

    /** 
     * @Route("/project_details/{id}",name="details_project",methods={"GET"})
     */

    public function details_project(int $id) : Response
    {
        $project = $this->projectRepository->find($id);
        $totalEmployee = $this->timeProjectRepository->findTotalEmployeeByProject($id);
        $employee = $this->timeProjectRepository->findAllProjectById($id);
        $cout = 0;
        for ($i=0; $i<count($employee); $i++)
        {
            $cout += ($employee[$i]->getDay()*$employee[$i]->getEmployee()->getDayCost());
        }
        

        return $this->render('details/detailProject.html.twig',[
            'title' => "Projets",
            'project' => $project,
            'totalEmployee' => count($totalEmployee),
            'cout' => $cout,
            'employees' => $employee
            
        ]);
    }

    /** 
     * @Route("/project_form/{id}/{action}",name="form_project",methods={"GET","POST"})
     */

    public function add_project(Request $request, int $id, string $action) : Response
    {
        $project = new Project;
        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            if (($id == 0)&&($action == 'add')){
                $project1 = new Project();
                $project1->setName($_POST['project']['name']);
                $project1->setDescription($_POST['project']['description']);
                $project1->setSalesPrice($_POST['project']['salesPrice']);
                $this->em->persist($project1);
                $this->em->flush();
                $this->addFlash('success', 'Votre ajout a été pris en compte');}
            else {
                $project1 = $this->projectRepository->find($id);
                $project1->setName($_POST['project']['name']);
                $project1->setDescription($_POST['project']['description']);
                $project1->setSalesPrice($_POST['project']['salesPrice']);
                $this->em->flush();
                $this->addFlash('success', 'Votre modification a été prise en compte');}
            // return $this->redirectToRoute('/job');
        }

        return $this->render('forms/formProject.html.twig',[
            'title' => "Projets",
            'form' => $form->createView()
        ]);
    }


   

}
