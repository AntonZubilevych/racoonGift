<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 01.08.18
 * Time: 15:24
 */

namespace App\GiftFinderTool\GiftReceiverToolFactory;



interface GiftReceiverInterface
{
    /**
     * Choose Category for your GiftReciever
     * @return string
     */
    public function chooseCategory (): string;

}