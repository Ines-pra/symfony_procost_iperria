<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Routing\Annotation\Route;

class EmployeesController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $em)
    {}

    
    /** 
     * @Route("/employees",name="main_employees",methods={"GET"})
     */

    public function employees() : Response
    {
        return $this->render('template/list.html.twig',[

            'title' => "Employés",
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
     * @Route("/employees_form",name="form_employees",methods={"GET"})
     */

    public function add_employees() : Response
    {
        return $this->render('forms/formEmployees.html.twig',[
            'title' => "Employés",
        ]);
    }
   

}
