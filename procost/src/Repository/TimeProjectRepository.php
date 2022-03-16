<?php

namespace App\Repository;

use App\Entity\TimeProject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TimeProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TimeProject::class);
    }


    public function findByEmployee(int $idEmployee):array
    {
        return $this
            ->createQueryBuilder('p')
            ->where('p.employee = :idEmployee')
            ->setParameter('idEmployee', $idEmployee)
            ->getQuery()
            ->getResult();    
        ;
    }

    public function findTotalEmployeeByProject(int $idProject):array
    {
        return $this
            ->createQueryBuilder('p')
            ->where('p.project = :idProject')
            ->setParameter('idProject', $idProject)
            ->groupBy('p.employee')
            ->getQuery()
            ->getResult();    
        ;
    }

    public function findAllProjectById(int $idProject):array
    {
        return $this
            ->createQueryBuilder('p')
            ->where('p.project = :idProject')
            ->setParameter('idProject', $idProject)
            ->getQuery()
            ->getResult();    
        ;
    }

    public function lastTenTimeProject():array
    {
        return $this
            ->createQueryBuilder('p')
            ->orderBy('p.created_at', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();  
    }

    // public function lastTimeProject() : Array
    // {
    //     return $this
    //         ->createQueryBuilder('p')
    //         ->groupBy('p.project')
    //         ->setMaxResults(5)
    //         ->getQuery()
    //         ->getResult();
    // }

    public function findEmployee(int $idEmployee): array
    {
        return $this
            ->createQueryBuilder('p')
            ->where('p.employee = :idEmployee')
            ->setParameter('idEmployee', $idEmployee)
            ->getQuery()
            ->getResult();    
        ;
    }

}

