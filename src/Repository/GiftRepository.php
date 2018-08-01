<?php

namespace App\Repository;

use App\Entity\Gift;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Gift|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gift|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gift[]    findAll()
 * @method Gift[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GiftRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Gift::class);
    }

   /**
     * @return Gift[] Returns an array of Gift objects
     */

    public function findByExampleFields($category,$price,$location,$hobby)
    {

        if ($location == 'All Ukraine'){
            $location = '*';
        }
        return $this->createQueryBuilder('g')
            ->andWhere('g.category = :category')
            ->andWhere('g.location = :location')
            ->andWhere('g.price > :price')
            ->orWhere('g.hobby = :hobby')
            ->setParameters([
                'category' => $category,
                'location' => $location,
                'price' => $price,
                'hobby' => $hobby
            ])

            ->orderBy('g.price', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findRandId()
    {
        $result =  $this->createQueryBuilder('p')
            ->orderBy('p.id', ' DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->execute();

        $MaxId = $result[0]->getId();

        return  \rand(1,$MaxId);

    }

    /*
    public function findOneBySomeField($value): ?Gift
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
