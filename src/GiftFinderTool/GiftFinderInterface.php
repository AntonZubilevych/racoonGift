<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 01.08.18
 * Time: 15:24
 */

namespace App\GiftFinderTool;


use App\Model\GiftReceiver\GiftReceiver;

interface GiftFinderInterface
{
    /**
     * @param GiftReceiver $receiver
     * @return string
     */
    public function chooseCategory(GiftReceiver $receiver): string;
}