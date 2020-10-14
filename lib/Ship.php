<?php

class Ship
{
    private $name;
    private $weaponPower = 0;
    private $jediFactor = 0;
    private $strength = 0;
    private $id;

    private $underRepair;

    public function __construct($name)
    {
        $this->name = $name;
        // give each ship a 30% chance of being under repair.
        $this->underRepair = mt_rand(1, 100) < 30;
    }

    public function isFunctional()
    {
        return !$this->underRepair;
    }



    public function getNameAndSpecs($useShortFormat = false ){

        if ($useShortFormat){

            return sprintf(
                '%s:, w:%s, j:%s, s:%s ',
                $this->name,
                $this->weaponPower,
                $this->jediFactor,
                $this->strength
            );

        } else {

            return sprintf(
                '%s:, %s, %s, %s ',
                $this->name,
                $this->weaponPower,
                $this->jediFactor,
                $this->strength
            );

        }

    }

    public function doesGivenShipHaveMoreStrength($givenShip){
        return $givenShip->strength > $this->strength;
    }

    public function setJediFactor($jediFactor){
        $this->jediFactor = $jediFactor;
    }

    public function setWeaponPower($weaponPower){
        $this->weaponPower = $weaponPower;
    }

    public function setShipName($name){
        $this->name = $name;
    }

    /**
     * @return int
     */public function getJediFactor()
    {
        return $this->jediFactor;
    }

    public function setStrength($strength){

        if(!is_numeric($strength)){


                throw new Exception("Strength Must be a number". $strength);

        } else {

            $this->strength = $strength;

        }


    }

    public function getShipName(){
         return $this->name;
    }

    /**
     * @return int
     */public function getStrength()
    {
        return $this->strength;
    }

    /**
     * @return int
     */
    public function getWeaponPower()
    {
        return $this->weaponPower;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}
