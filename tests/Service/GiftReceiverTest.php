<?php


namespace App\Tests\Service;


use App\Model\GiftReceiver\GiftReceiverFactory;
use App\Model\GiftReceiver\GiftReceiver;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;


class GiftReceiverTest extends TestCase
{
    private $giftReceiverFactory;
    public function  setUp()
    {
        $this->giftReceiverFactory = new GiftReceiverFactory();
    }
    public function testChoosenCategory()
    {
        $giftReceiver = $this->giftReceiverFactory->create(15,'','','','');
        self::assertEquals('children',$this->giftReceiverFactory->chooseCategory($giftReceiver));
    }
}