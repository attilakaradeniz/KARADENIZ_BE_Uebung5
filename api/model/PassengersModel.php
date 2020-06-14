<?php
class PassengersModel
{
    private $dbGateway;

    public function __construct()
    {
        $this->dbGateway = new DBGatewayModel();
    }


    public function getPassengers($flightId)
    {
        $statement = "SELECT flights.id, flightname, lastname, firstname FROM flights JOIN passengers ON flights.id = passengers.flights_id WHERE flights.id={$flightId};";
        return $this->dbGateway->query($statement);

    }
}
