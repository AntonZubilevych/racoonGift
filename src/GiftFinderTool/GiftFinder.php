<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 25.07.18
 * Time: 21:33
 */

namespace App\GiftFinderTool;


use App\Model\GiftReceiver\GiftReceiver;

class GiftFinder implements GiftFinderInterface
{

    /**
     * @param GiftReceiver $receiver
     * @return string
     */
    public function chooseCategory(GiftReceiver $receiver):string
    {
        $age = $receiver->getAge();
        $sex = $receiver->getSex();

        echo $sex;
        switch (true) {
            case ($age <=16):
                return 'children';
                break;
            case ($age > 16 && $age <= 24 && $sex == 'male'):
                return 'boyTeen';
                break;
            case ($age > 16 && $age <= 24 && $sex == 'female'):
                return 'girlTeen';
                break;
            case ($sex == 'male' && $age > 24 && $age <35  ):
                return 'men';
            case ($age > 24  && $sex == 'female' && $age <35 ):
                return 'women';
                break;
            case ($age >= 35 ):
                return 'older';
                break;

        }
    }
}