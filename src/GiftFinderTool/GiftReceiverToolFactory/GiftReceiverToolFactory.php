<?php

namespace App\GiftFinderTool\GiftReceiverToolFactory;

use App\GiftFinderTool\ToolFactoryInterface;

class GiftReceiverToolFactory implements ToolFactoryInterface
{

    public function create():GiftReceiver
    {
        return new GiftReceiver();
    }
}