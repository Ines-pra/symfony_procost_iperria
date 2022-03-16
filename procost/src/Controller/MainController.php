<?php

namespace App\Controller;

use App\Repository\EmployeesRepository;
use App\Repository\JobRepository;
use App\Repository\ProjectRepository;
use App\Repository\TimeProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\ORM\EntityManagerInterface;

class MainController extends AbstractController 
{

    public function __construct(
        private EntityManagerInterface $em, 
        private ProjectRepository $projectRepository,
        private EmployeesRepository $employeesRepository,
        private JobRepository $jobRepository,
        private TimeProjectRepository $timeProjectRepository)
    {
    }   

    /** 
     * @Route("/",name="main_homepage",methods={"GET"})
     */

    public function main() : Response
    {
        $projects = $this->projectRepository->findAll();
        $employees = $this->employeesRepository->findAll();

        //projets délivrés et en cours
        $projectsFinish=0;
        $projectsNoFinish=0;
        
        for ($i=0 ; $i<count($projects) ; $i++) 
        {
            $projectsF = $projects[$i]->getDeliverDate();
            if (empty($projectsF)) $projectsNoFinish++;
            else $projectsFinish++;
        }

        //temps de production
        $timeProject = $this->timeProjectRepository->findAll();
        $totalDay = 0;
        for ($i=0 ; $i<count($timeProject) ; $i++)
        {
            $totalDay += $timeProject[$i]->getDay();
        }

        //10 derniers temps de production recencés
        $lastTenTimeProject = $this->timeProjectRepository->lastTenTimeProject();

        //top employé
        $employeePay = [];
        $totalCostProject = [];
        foreach ($timeProject as $timeP)
        {
            if (empty($employeePay[$timeP->getEmployee()->getId()]))
            $employeePay[$timeP->getEmployee()->getId()] = $timeP->getDay()*$timeP->getEmployee()->getDayCost();
            else $employeePay[$timeP->getEmployee()->getId()] += $timeP->getDay()*$timeP->getEmployee()->getDayCost();
        
            if (empty($totalCostProject[$timeP->getProject()->getId()]))
            $totalCostProject[$timeP->getProject()->getId()] = $timeP->getDay()*$timeP->getEmployee()->getDayCost();
            else $totalCostProject[$timeP->getProject()->getId()] += $timeP->getDay()*$timeP->getEmployee()->getDayCost();
        }

        $maxEmployeePay = max($employeePay);
        $topEmployee = $this->employeesRepository->find(array_search($maxEmployeePay,$employeePay));


        //les 5 derniers projets + utilisation du tableau de tous les salaires
        $lastProjects = $this->projectRepository->lastProject();
        foreach ($projects as $project)
        {
            {
                print_r('Projet '.$project->getId().' non recencés');
                $totalCostProject[$project->getId()] = "Aucune dépense recencée";
            }
        }


        //rentabilité des projets 
        $totalNoRateProject = 0;
        foreach ($totalCostProject as $totalCP)
        {
            if (($totalCP > $this->projectRepository->find(array_search($totalCP,$totalCostProject))->getSalesPrice())&&
            (!empty($this->projectRepository->find(array_search($totalCP,$totalCostProject))->getDeliverDate()))) $totalNoRateProject++ ;            
        }

        //taux de livraison : utilisation de la liste de tous les projets et de la liste de tous les projets finis

        return $this->render('template/index.html.twig',[
            'title' => "Homepage",
            'totalProject' => count($projects),
            'projectF' => $projectsFinish,
            'projectNF' => $projectsNoFinish,
            'totalEmployee' => count($employees),
            'totalDay' => $totalDay,
            'lastTenTimeProject' => $lastTenTimeProject,
            'lastProjects' => $lastProjects,
            'maxEmployeePay' => $maxEmployeePay,
            'topEmployee' => $topEmployee,
            'totalNoRateProject' => $totalNoRateProject,
            'totalCostProject' => $totalCostProject,
        ]);
    }

}