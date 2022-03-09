<?php

namespace App\DataFixtures;

use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

        $this->loadJob();

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }

    private function loadJob():void 
    {
        for($i=0; $i <5; $i++)
        {
            $job = new Job();
            $job->setName('Nom '.$i);
            
            $this->manager->persist($job);
        }
        
    }
}
