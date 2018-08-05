<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 25.07.18
 * Time: 22:36
 */

namespace App\GiftFinder;

use App\Entity\Category;

class GiftReceiver implements GiftReceiverInterface
{
    protected $age;
    protected $price;
    protected $sex;
    protected $location;
    protected $hobby;

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age): void
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @param mixed $sex
     */
    public function setSex($sex): void
    {
        $this->sex = $sex;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location): void
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getHobby()
    {
        return $this->hobby;
    }

    /**
     * @param mixed $hobby
     */
    public function setHobby($hobby): void
    {
        $this->hobby = $hobby;
    }

    public function chooseCategory():string
    {
        switch (true) {
            case ($this->age <=16):
                return Category::CHILDREN;
            case ($this->age > 16 && $this->age <= 24 && $this->sex == 'male'):
                return Category::TEEN_BOY;
            case ($this->age > 16 && $this->age <= 24 && $this->sex == 'female'):
                return Category::TEEN_GIRL;
            case ($this->sex == 'male' && $this->age > 24 && $this->age <35  ):
                return Category::MEN;
            case ($this->sex > 24  && $this->sex == 'female' && $this->age <35 ):
                return Category::WOMEN;
            case ($this->age >= 35 ):
                return  Category::OLDER;
        }
    }
}