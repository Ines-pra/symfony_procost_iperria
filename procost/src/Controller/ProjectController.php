<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Project;
use App\Form\ProjectType;

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
     * @Route("/project_form",name="form_project",methods={"GET","POST"})
     */

    public function add_project(Request $request) : Response
    {
        $project = new Project;
        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->addFlash('success', 'Votre ajout a été pris en compte');
            // return $this->redirectToRoute('/project');
        }

        return $this->render('forms/formProject.html.twig',[
            'title' => "Projets",
            'form' => $form->createView()
        ]);
    }


   

}
