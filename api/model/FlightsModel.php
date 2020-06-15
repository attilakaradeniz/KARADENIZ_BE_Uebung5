<?php


class FlightsModel
{
    private $dbGateway;

    public function __construct()
    {
        $this->dbGateway = new DBGatewayModel();
    }

    public function getFlights()
    {
        $statement = "SELECT * FROM flights";
        return $this->dbGateway->query($statement);
    }


}