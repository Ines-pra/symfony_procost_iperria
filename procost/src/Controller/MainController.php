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
        $projectsFinish=0;
        $projectsNoFinish=0;
        
        for ($i=0 ; $i<count($projects) ; $i++) 
        {
            $projectsF = $projects[$i]->getDeliverDate();
            if (empty($projectsF)) $projectsNoFinish++;
            else $projectsFinish++;
        }

        $employees = $this->employeesRepository->findAll();
        
        $timeProject = $this->timeProjectRepository->findAll();
        $totalDay = 0;
        for ($i=0 ; $i<count($timeProject) ; $i++)
        {
            $totalDay += $timeProject[$i]->getDay();
        }

        $lastTenTimeProject = $this->timeProjectRepository->lastTenTimeProject();

        // $lastProjects = $this->projectRepository->lastProject();

        // // $lastProjects = $this->timeProjectRepository->lastTimeProject();

        // for($i = 0 ; $i<count($lastProjects) ; $i++)
        // {
        //     $last = $this->timeProjectRepository->findAllProjectById($lastProjects[$i]->getId());
        // }


        $employeePay = [];
        foreach ($timeProject as $timeP  )
        {
            if (empty($employeePay[$timeP->getEmployee()->getId()]))
            $employeePay[$timeP->getEmployee()->getId()] = $timeP->getDay()*$timeP->getEmployee()->getDayCost();
            else $employeePay[$timeP->getEmployee()->getId()] += $timeP->getDay()*$timeP->getEmployee()->getDayCost();
        }

        $maxEmployeePay = max($employeePay);
        $topEmployee = $this->employeesRepository->find(array_search($maxEmployeePay,$employeePay));

        return $this->render('template/index.html.twig',[
            'title' => "Homepage",
            'totalProject' => count($projects),
            'projectF' => $projectsFinish,
            'projectNF' => $projectsNoFinish,
            'totalEmployee' => count($employees),
            'totalDay' => $totalDay,
            'lastTenTimeProject' => $lastTenTimeProject,
            // 'lastProjects' => $last
            'maxEmployeePay' => $maxEmployeePay,
            'topEmployee' => $topEmployee
        ]);
    }

}