<?php

require_once __DIR__ . "/lib/Ship.php";

function printShipSummary($myShip)
{

    $myShip->name = "This Alex Express";
    $myShip->weaponPower = 10;

    echo $myShip->getName();
    echo $myShip->getNameAndSpecs(false);

}

$ship = new Ship();
$ship->name = "Devil ship";
$ship->weaponPower = 20;
$ship->jediFactor = 15;
$ship->strength = 100;


$otherShip = new Ship();
$otherShip->name = "Alex pimp ship";
$otherShip->weaponPower = 20;


printShipSummary($ship);
echo "<hr>";
printShipSummary($otherShip);
echo "<hr>";

// Lets do soem shit;

if($ship->doesGivenShipHaveMoreStrength($otherShip)){

    echo "My ship is the more strong";


} else {


    echo "Youre ship is the more strong";
}