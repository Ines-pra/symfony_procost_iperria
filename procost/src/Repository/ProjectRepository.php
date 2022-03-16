<?php

namespace App\Repository;

use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use PhpParser\Node\Expr\Cast\Array_;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Project::class);
    }

    
    // public function findByDeliverDate() : Array
    // {
    //     return $this
    //         ->createQueryBuilder('p')
    //         ->where('p.deliverDate = NULL')
    //         ->getQuery()
    //         ->getResult();
    // }

    public function lastProject() : Array
    {
        return $this
                ->createQueryBuilder('p')
                ->orderBy('p.created_at', 'DESC')
                ->setMaxResults(5)
                ->getQuery()
                ->getResult();
    }


}

