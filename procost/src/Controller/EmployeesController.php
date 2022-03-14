<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Employees;
use App\Form\EmployeesType;
use App\Repository\EmployeesRepository;
use App\Repository\JobRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Request;

class EmployeesController extends AbstractController
{

    public function __construct(
        private EntityManagerInterface $em,
        private EmployeesRepository $employeesRepository,
        private JobRepository $jobRepository)
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
     * @Route("/employees_details/{id}",name="details_employees",methods={"GET"})
     */

    public function details_employees(int $id) : Response
    {
        $employee = $this->employeesRepository->findOneBySomeField($id);
        return $this->render('details/detailEmployees.html.twig',[
            'title' => "Employés",
            'employee' => $employee
        ]);
    }

    /** 
     * @Route("/employees_form/{id}/{action}",name="form_employees",methods={"GET","POST"})
     */

    public function add_employees(Request $request, int $id, string $action) : Response
    {
        $employees = new Employees;
        $form = $this->createForm(EmployeesType::class, $employees);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $createdAt = $_POST['employees']['createdAt']['month'].'.'.$_POST['employees']['createdAt']['day'].'.'.$_POST['employees']['createdAt']['year'];
            if (($id == 0)&&($action == 'add')){
                $employee1 = new Employees();
                $employee1->setFirstName($_POST['employees']['firstName']);
                $employee1->setLastName($_POST['employees']['lastName']);
                $employee1->setEmail($_POST['employees']['email']);
                $employee1->setJob($this->jobRepository->find($_POST['employees']['job']));
                $employee1->setDayCost($_POST['employees']['dayCost']);
                $employee1->setCreatedAt(new DateTime($createdAt));
                $this->em->persist($employee1);
                $this->em->flush();
                $this->addFlash('success', 'Votre ajout a été pris en compte');}
            else {
                $employee1 = $this->employeesRepository->find($id);
                $employee1->setFirstName($_POST['employees']['firstName']);
                $employee1->setLastName($_POST['employees']['lastName']);
                $employee1->setEmail($_POST['employees']['email']);
                $employee1->setJob($this->jobRepository->find($_POST['employees']['job']));
                $employee1->setDayCost($_POST['employees']['dayCost']);
                $employee1->setCreatedAt(new DateTime($createdAt));
                $this->em->flush();
                $this->addFlash('success', 'Votre modification a été prise en compte');}
            // return $this->redirectToRoute('/job');
        }

        return $this->render('forms/formEmployees.html.twig',[
            'title' => "Employés",
            'form' => $form->createView(),
            'action' => $action
        ]);
    }
   

}
