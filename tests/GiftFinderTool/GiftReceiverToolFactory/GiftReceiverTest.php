<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 03.08.18
 * Time: 18:15
 */

namespace App\Tests\GiftFinderTool\GiftReceiverToolFactory;


use App\GiftFinderTool\GiftReceiverToolFactory\GiftReceiverToolFactory;
use PHPUnit\Framework\TestCase;

class GiftReceiverTest extends TestCase
{
    private $giftReceiverToolFactory;
    public function  setUp()
    {
        $this->giftReceiverToolFactory = new GiftReceiverToolFactory();
    }
    public function testChooseCategory()
    {
        $giftReceiver = $this->giftReceiverToolFactory->create();
        $giftReceiver->setAge(13);
        self::assertEquals('children',$giftReceiver->chooseCategory($giftReceiver));
    }
}