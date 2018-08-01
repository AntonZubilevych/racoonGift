<?php
/**
 * Created by PhpStorm.
 * User: anton
 * Date: 25.07.18
 * Time: 22:36
 */

namespace App\Model\GiftReceiver;


class GiftReceiver
{
    protected $age;
    protected $price;
    protected $sex;
    protected $location;
    protected $hobby;

    static public function fromForm()
    {

    }

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
}