<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 02.08.18
 * Time: 14:01
 */

namespace App\GiftFinderTool;




use App\Entity\Result;
use App\FileSystem\FileNameInterface;

class GiftStatistics
{
    static public function saveResult($entityManager ,$id):bool
    {
        $result = new Result();
        $result->getGift($id);
        $result->setCreatedAt(new \DateTime());
        try{
            $entityManager->persist($result);
            $entityManager->flush();
        }catch (\RuntimeException $e){
            throw new \RuntimeException('Something bad with saving results');
        }
    }
}