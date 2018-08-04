<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 03.08.18
 * Time: 17:48
 */

namespace App\GiftFinderTool\StatisticsToolFactory;

use App\GiftFinderTool\ToolFactoryInterface;


class StatisticsToolFactory implements ToolFactoryInterface
{

    public function create()
    {
       return new StatisticsToolFactory();
    }
}