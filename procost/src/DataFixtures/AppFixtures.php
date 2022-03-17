<?php

namespace App\DataFixtures;

use App\Entity\Employees;
use App\Entity\Project;
use App\Entity\Job;
use App\Entity\TimeProject;
use App\Repository\EmployeesRepository;
use App\Repository\ProjectRepository;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function __construct(
        private ProjectRepository $projectRepository,
        private EmployeesRepository $employeesRepository)
    {
    }   

    private const DATA_PROJECT = [
        [
            'name' => 'Procost',
            'description' => 'Projet symfony',
        ],
        [
            'name' => 'Shoefony',
            'description' => 'Projet symphony',
        ],
        [
            'name' => 'MindRace',
            'description' => 'Projet PHP et JS',
        ],
        [
            'name' => 'Pokédex',
            'description' => 'Projet JS',
        ],
        [
            'name' => 'Netflix',
            'description' => 'Projet React',
        ],
        [
            'name' => 'Cicero',
            'description' => 'Projet tutoré',
        ],
    ];

    private const DATA_EMPLOYEES = [
        [
            'name' => 'Perria',
            'firstname' => 'Inès',
            'email' => 'perria.ines@gmail.com',
        ],
        [
            'name' => 'Martin',
            'firstname' => 'Florian',
            'email' => 'martin.florian@gmail.com',
        ],
        [
            'name' => 'Chalopin',
            'firstname' => 'Alexy',
            'email' => 'chalopin.alexy@gmail.com',
        ],
        [
            'name' => 'Schmitt',
            'firstname' => 'Alexandre',
            'email' => 'schmitt.alexandre@gmail.com',
        ],
        [
            'name' => 'Cazzoli',
            'firstname' => 'Valentin',
            'email' => 'cazzoli.valentin@gmail.com',
        ],
        [
            'name' => 'Humbert',
            'firstname' => 'Guillaume',
            'email' => 'humbert.guilaume@gmail.com',
        ]
    ];

    private const DATA_JOB = [
        ['Développeur/euse informatique'],
        ['Développeur/euse multimédia'],
        ['Chef/fe de projet web'],
        ['WebMaster'],
        ['Web Designer'],
        ['Traffic Manager'],
        ['Hot Liner'],
        ['Community Manager'],
        ['Administrateur/trice de bases de données'],
        ['Analyste SOC'],
        ['Consultant/e en cyber-sécurité'],
        ['Data Scientist']
    ];

    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

        $this->loadJob();
        $manager->flush();

        $this->loadData();
        $manager->flush();
    }

    private function loadJob():void 
    {

        foreach (self::DATA_JOB as $key => [$name]) {
            $job = new Job();
            $job->setName($name);
            $this->manager->persist($job);
            $this->addReference(Job::class . $key, $job);
        }
    }


    private function loadData():void
    {
        $date[0]=NULL;
        $date[1]= new DateTime(date('d-m-y h:i:s'));
        for ($i=0 ; $i < count(self::DATA_EMPLOYEES) ; $i++ )
        {
            $id = rand(0,1);

            $project = new Project();
            $project->setName(self::DATA_PROJECT[$i]['name']);
            $project->setDescription(self::DATA_PROJECT[$i]['description']);
            $project->setSalesPrice(random_int(1500,20000));
            $project->setDeliverDate($date[$id]);
            
            $employees = new Employees();
            $employees->setLastName(self::DATA_EMPLOYEES[$i]['name']);
            $employees->setFirstName(self::DATA_EMPLOYEES[$i]['firstname']);
            $employees->setJob($this->getRandomEntityReference(Job::class, self::DATA_JOB));
            $employees->setEmail(self::DATA_EMPLOYEES[$i]['email']);
            $employees->setDayCost(random_int(200,4000));
            $employees->setCreatedAt(new \DateTime(date('d-m-y h:i:s')));

            $timeProject = new TimeProject();
            $timeProject->setEmployee($employees);
            $timeProject->setProject($project);
            $timeProject->setDay(random_int(1,7));
            $timeProject->setCreatedAt(new \DateTime(date('d-m-y h:i:s')));
            
            
            $this->manager->persist($employees);
            $this->manager->persist($project);
            $this->manager->persist($timeProject);

            sleep(1);
        }  
    }

    /**
     * @param class-string $entityClass
     * 
     * @return object<class-string>
     */
    private function getRandomEntityReference(string $entityClass, array $data): object {
        return $this->getReference($entityClass . random_int(0, count($data) - 1));
    }
}
