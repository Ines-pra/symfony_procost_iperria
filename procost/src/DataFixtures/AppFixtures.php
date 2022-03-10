<?php

namespace App\DataFixtures;

use App\Entity\Employees;
use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private const DATA_EMPLOYEES = [
        [
            'name' => 'User1',
            'firstname' => 'userr',
            'email' => 'user1@gmail.com',
            'job' => 'JOB',
            'dayCost' => 600,
            // 'dateJob' => new \DateTime("2022-01-02 00:00:00")
        ],
        [
            'name' => 'User2',
            'firstname' => 'usser',
            'email' => 'user2@gmail.com',
            'job' => 'JOB',
            'dayCost' => 200,
            // 'dateJob' => new \DateTime("2020-02-02 00:00:00")
        ],
        [
            'name' => 'User3',
            'firstname' => 'uuser',
            'email' => 'user3@gmail.com',
            'job' => 'JOB',
            'dayCost' => 350,
            // 'dateJob' => new \DateTime("2018-05-03 00:00:00")
        ],
        [
            'name' => 'User4',
            'firstname' => 'useer',
            'email' => 'user4@gmail.com',
            'job' => 'JOB',
            'dayCost' => 735,
            // 'dateJob' => new \DateTime("2015-04-18 s00:00:00")
        ]
    ];

    private const DATA_JOB = [
        ['SEO'],
        ['Developpeur'],
        ['Analyste']
    ];

    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

        $this->loadJob();
        $this->loadEmployees();
        // $product = new Product();
        // $manager->persist($product);

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
        // for($i=0; $i <=2; $i++)
        // {
        //     $job = new Job();
        //     $job->setName(self::DATA_JOB[$i]);
            
        //     $this->manager->persist($job);
        // }
        
    }

    private function loadEmployees(): void
    {
        for($i=0; $i <=3; $i++)
        {
            $date = new \DateTime();
            $employees = new Employees();
            $employees->setLastName(self::DATA_EMPLOYEES[$i]['name']);
            $employees->setFirstName(self::DATA_EMPLOYEES[$i]['firstname']);
            $employees->setJob($this->getRandomEntityReference(Job::class, self::DATA_JOB));
            $employees->setEmail(self::DATA_EMPLOYEES[$i]['email']);
            $employees->setDayCost(self::DATA_EMPLOYEES[$i]['dayCost']);
            $employees->setCreatedAt($date);
            
            $this->manager->persist($employees);
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
