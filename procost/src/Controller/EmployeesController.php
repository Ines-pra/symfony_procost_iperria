<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Employees;
use App\Form\EmployeesType;
use App\Repository\EmployeesRepository;
use Symfony\Component\HttpFoundation\Request;

class EmployeesController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $em,
        private EmployeesRepository $employeesRepository)
    {}

    
    /** 
     * @Route("/employees",name="main_employees",methods={"GET"})
     */

    public function employees() : Response
    {
        $employees = $this->employeesRepository->findAll();

        return $this->render('template/list.html.twig',[
            'title' => "Employés",
            'employees' => $employees
        ]);
    }

    /** 
     * @Route("/employees_details",name="details_employees",methods={"GET"})
     */

    public function details_employees() : Response
    {

        return $this->render('details/detailEmployees.html.twig',[
            'title' => "Employés",
        ]);
    }

    /** 
     * @Route("/employees_form",name="form_employees",methods={"GET","POST"})
     */

    public function add_employees(Request $request) : Response
    {

        $employees = new Employees;
        $form = $this->createForm(EmployeesType::class, $employees);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->addFlash('success', 'Votre ajout a été pris en compte');
            // return $this->redirectToRoute('/employees');
        }

        return $this->render('forms/formEmployees.html.twig',[
            'title' => "Employés",
            'form' => $form->createView()
        ]);
    }
   

}
