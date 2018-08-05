<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 02.08.18
 * Time: 14:01
 */

namespace App\GiftFinder;


class GiftStatistics implements StatisticsInterface
{
    private $result;

    public function __construct(Result $result)
    {
        return $this->result = $result;
    }

    public function saveResult($entityManager ,$id):bool
    {
        try {
            $this->result->setGift($id);
            $this->result->setCreatedAt(new \DateTime());
            $entityManager->persist($this->result);
            $entityManager->flush();
        } catch (\RuntimeException $e) {
            return null;
        }
    }
}

