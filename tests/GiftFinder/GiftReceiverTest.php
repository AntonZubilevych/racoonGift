<?php

namespace App\Tests\GiftFinderTool\GiftReceiverToolFactory;

use App\GiftFinder\GiftReceiver;
use PHPUnit\Framework\TestCase;

class GiftReceiverTest extends TestCase
{
    private $giftReceiver;

    public function  setUp()
    {
        $this->giftReceiver = new GiftReceiver();
    }
    public function testChooseCategory()
    {
        $this->giftReceiver->setAge(13);
        self::assertEquals('children', $this->giftReceiver->chooseCategory());
    }
}