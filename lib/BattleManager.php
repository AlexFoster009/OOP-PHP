<?php

/*
 * You should create a class anytime you need to create some data.
 * or, if you need to do a function that does some work,
 * for Exampel the ship class would be te data we are creating and the BattleManager class is the class
 * we need to do some work to have the ship objects interact.
 */


class BattleManager
{
    //This will handle the battle functionality on ships.
    public /**
     * Our complex fighting algorithm!
     *
     * @param Ship $ship1
     * @param $ship1Quantity
     * @param Ship $ship2
     * @param $ship2Quantity
     * @return BattleResult
     */
    function battle( Ship $ship1, $ship1Quantity, Ship $ship2, $ship2Quantity)
    {
        $ship1Health = $ship1->getStrength() * $ship1Quantity;
        $ship2Health = $ship2->getStrength() * $ship2Quantity;

        $ship1UsedJediPowers = false;
        $ship2UsedJediPowers = false;
        while ($ship1Health > 0 && $ship2Health > 0) {
            // first, see if we have a rare Jedi hero event!
            if ($this->didJediDestroyShipUsingTheForce($ship1)) {
                $ship2Health = 0;
                $ship1UsedJediPowers = true;

                break;
            }
            if ($this->didJediDestroyShipUsingTheForce($ship2)) {
                $ship1Health = 0;
                $ship2UsedJediPowers = true;

                break;
            }

            // now battle them normally
            $ship1Health = $ship1Health - ($ship2->getWeaponPower() * $ship2Quantity);
            $ship2Health = $ship2Health - ($ship1->getWeaponPower() * $ship1Quantity);
        }

       $ship1->setStrength($ship1Health);
        $ship2->setStrength($ship2Health);



        if ($ship1Health <= 0 && $ship2Health <= 0) {
            // they destroyed each other
            $winningShip = null;
            $losingShip = null;
            $usedJediPowers = $ship1UsedJediPowers || $ship2UsedJediPowers;
        } elseif ($ship1Health <= 0) {
            $winningShip = $ship2;
            $losingShip = $ship1;
            $usedJediPowers = $ship2UsedJediPowers;
        } else {
            $winningShip = $ship1;
            $losingShip = $ship2;
            $usedJediPowers = $ship1UsedJediPowers;
        }

        // Return new BattelREsult object that contains the attle results;
        return new BattleResult($winningShip, $losingShip, $usedJediPowers);

        return array(
            'winning_ship' => $winningShip,
            'losing_ship' => $losingShip,
            'used_jedi_powers' => $usedJediPowers,
        );
    }

    private function didJediDestroyShipUsingTheForce(Ship $ship)
    {
        /*
         * Since the work being done with this function lives only in teh class
         * we can make this methods private.
         */
        $jediHeroProbability = $ship->getJediFactor() / 100;

        return mt_rand(1, 100) <= ($jediHeroProbability*100);
    }

}