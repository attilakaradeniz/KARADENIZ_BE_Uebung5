<?php

class FlightsController
{
    private $jsonView;

    public function __construct()
    {
        $this->jsonView = new JsonView();
    }

    public function route()
    {
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

        switch (strtoupper($action)) {
            case 'GET-FLIGHTS' :
                $flightsFormatted = [];
                $flights = $this->showFlights();
                foreach ($flights as $flight) {
                    $flightsFormatted['flights'][] = array('flightId:' => $flight['id'], 'name:' => $flight['flightname'], 'url' => $flight['url']);
                }
                $this->jsonView->output($flightsFormatted);
                break;

            case 'GET-PASSENGERS' :
                $flightId = filter_input(INPUT_GET, 'flightId', FILTER_SANITIZE_NUMBER_INT);
                if (!$flightId) {
                    $this->jsonView->output(
                        ["An error occurred:" => "You have to provide a valid flight ID for the respective passenger list",
                            "After GET_PASSENGERS provide an id with the parameter prefix {flightId} like this:" => "&flightId={id}"]);
                } else {
                    $passengerList = [];
                    $passengers = $this->showPassengers($flightId);
                    foreach ($passengers as $passenger) {
                        $passengerList['passengers'][] = array('flightName' => $passenger['flightname'], 'lastname' => $passenger['lastname'], 'firstname' => $passenger['firstname']);
                    }
                    if ($passengerList == null) {
                        $this->jsonView->output(["An error ocurred:" => "Please provide a valid flight ID"]);
                    } else {
                        $this->jsonView->output($passengerList);
                    }
                }
                break;
            default :
                $this->jsonView->output(["An Error occurred!" => "Interface not found!", "Possible parameters for action are: " => "GET-FLIGHTS, GET_PASSENGERS&FLIGHTID=[id]"]);
            //return false;
        }
    }

    private function showFlights()
    {
        $flightsModel = new FlightsModel();
        $flights = $flightsModel->getFlights();
        $url = "http://localhost/KARADENIZ_BE_Uebung5/api/?action=GET-PASSENGERS&flightId=";
        //print_r($flights); // TEST
        foreach ($flights as &$flight) {
            $flight['url'] = $url . $flight['id'];
        }
        return $flights;
    }

    public function showPassengers($flightId)
    {
        $passengersModel = new PassengersModel();
        $passengers = $passengersModel->getPassengers($flightId);
        return $passengers;
    }
}
