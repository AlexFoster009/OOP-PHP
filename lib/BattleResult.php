<?php
// Hold data for winning ship, losing ship and if the jedi power was used.

class BattleResult
{
    private $winningShip;
    private $losingShip;
    private $usedJediPowers;

    public function __construct(Ship $winningShip = null, Ship $losingShip = null , $usedJediPowers)
    {
        // All properties are required to generate a result,
        // ensure an object can only be created with these properties set.
        $this->winningShip = $winningShip;
        $this->losingShip= $losingShip;
        $this->usedJediPowers = $usedJediPowers;

    }

    /**
     * @return Ship|null
     */
    public function getWinningShip()
    {
        return $this->winningShip;
    }

    /**
     * @return Ship|null
     */
    public function getLosingShip()
    {
        return $this->losingShip;
    }

    /**
     * @return boolean
     */
    public function wereJediPowersUsed()
    {
        return $this->usedJediPowers;
    }

    public function isThereAWinner()
    {
        return $this->getWinningShip() !== null;
    }

}