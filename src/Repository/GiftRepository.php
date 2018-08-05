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

    public function findGiftByFields($category,$price,$location,$hobby)
    {

        if ($location == 'All Ukraine'){
            $location = '*';
        }
        return $this->createQueryBuilder('g')
            ->select('g.id')
            ->Where('g.category = :category')
            ->andWhere('g.location = :location')
            ->andWhere('g.price > :price')
            ->orWhere('g.hobby = :hobby')
            ->setParameters([
                'category' => $category,
                'location' => $location,
                'price' => $price,
                'hobby' => $hobby
            ])
            ->setMaxResults(1)
            ->getQuery()
            ->execute();

    }

    public function findRandId():int
    {
        $result =  $this->createQueryBuilder('p')
            ->orderBy('p.id', ' DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->execute();

        $id = $result[0]->getId();

        return  \rand(1, $id);
    }

}
