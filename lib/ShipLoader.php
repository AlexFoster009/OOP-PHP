<?php
/*
 * This class will be responsible for generating ship objects that
 * will be displayed in the app, ready for battle.
 */

class ShipLoader
{

    /**
     * @return Ship[];
     */

    public  function getShips()
    {
        $shipsData = $this->queryForShips();
        $ships = array();

        /*
         * Loop through all records from query and create new objects.
         * We do this becasue the query returns an array, and this turns then into an array of objects.
         */

        foreach($shipsData as $shipData){
            $ships[] = $this->createShipFromData($shipData);
        }

        return $ships;

    }

    /**
     * @param $id
     * @return Ship|null
     */

    public function findOneById($id)
    {
        $pdo = new PDO('mysql:host=localhost;dbname='.'oo_battle', 'root', 'Tanglewood@7');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Set statement result ro query,
        $statement = $pdo->prepare('SELECT * FROM ship WHERE id = :id');
        $statement->execute(array('id' => $id));

        $shipArray = $statement->fetch(PDO::FETCH_ASSOC);

        if(!$shipArray){
            return null;
        }

        return $this->createShipFromData($shipArray);
    }

    private function createShipFromData(array $shipData)
    {
        // Convert the array into a ship object.
        $ship = new Ship($shipData['name']);
        $ship->setId($shipData['id']);
        $ship->setStrength($shipData['strength']);
        $ship->setWeaponPower($shipData['weapon_power']);
        $ship->setJediFactor($shipData['jedi_factor']);

        return $ship;
    }

    // Method for querying ships
    private function queryForShips()
    {
        // Instead we will grab ships from the database instead of hard coding them.
        $pdo = new PDO('mysql:host=localhost;dbname='.'oo_battle', 'root', 'Tanglewood@7');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Set statement result ro query,
        $statement = $pdo->prepare('SELECT * FROM ship');
        $statement->execute();

        $shipArray = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $shipArray;
    }
}