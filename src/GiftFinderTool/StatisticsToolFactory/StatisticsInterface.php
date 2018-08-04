<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 03.08.18
 * Time: 13:57
 */

namespace App\GiftFinderTool\StatisticsToolFactory;


interface StatisticsInterface
{
    public function saveResult($entityManager,$id):bool;
}