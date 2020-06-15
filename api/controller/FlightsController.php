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

            switch (strtoupper($action))
            {
                case 'GET-FLIGHTS' :
                    // echo "case: get flights"; // TEST
                    $this->showFlights();
                    break;

                case 'GET-PASSENGERS' :
                    //echo "case : get passengers"; // TEST
                    $flightId = filter_input(INPUT_GET, 'flightId',FILTER_SANITIZE_NUMBER_INT);
                    //$passengersSend = $this->showPassengers($flightId);
                    //$this->jsonView->output($passengersSend);
                if(!$flightId)
                {
                    $this->jsonView->output(
                        ["An error occurred:" => "You have to specify a flight id for the respective passenger list",
                        "After GET_PASSENGERS provide an id with the parameter prefix {flightId} like this:" => "&flightId={id}"]);
                }
                else
                {
                    //echo "passengers"; // TEST
                    //$this->jsonView->output($this->showPassengers($flightId));
                    //print_r($this->showPassengers($flightId));
                    $passengerList = [];
                    //print_r($passengerList);
                    $passengers = $this->showPassengers($flightId);
                    //print_r($passengers);

                    //$passengerList['flightName'] = $passengers[0]['flightname'];
                    //print_r($passengerList);
                    //$this->jsonView->output($passengerList);
                    foreach ($passengers as $passenger) {
//                        $passengerList['passengers'][] = array('lastname' => $passenger['lastname'], 'firstname' => $passenger['firstname']);
                        //$passengerList['flightName'][] = array($passenger['flightname']);
                        //print_r($passenger);
                        $passengerList['passengers'][] = array('flightName' => $passenger['flightname'], 'lastname' => $passenger['lastname'], 'firstname' => $passenger['firstname']);
                        //print_r($passengerList);
                    }
                    $this->jsonView->output($passengerList);

                    //$this->showPassengers($passengerList);
                }
                    break;
                default : $this->jsonView->output(["An Error occurred!" => "Interface not found!", "Possible parameters for action are: " => "GET-FLIGHTS, GET_PASSENGERS&FLIGHTID=[id]"]);
                //return false;
            }

        }

        private function showFlights()
        {
            $flightsModel = new FlightsModel();
            $flights = $flightsModel->getFlights();
            $url = "http://localhost/KARADENIZ_BE_Uebung5/api/?action=GET-PASSENGERS&flightId=";
            //print_r($flights); // TEST
            foreach ($flights as &$flight)
            {
                $flight['url'] = $url . $flight['id'];
            }
            $this->jsonView->output($flights);
        }

        public function showPassengers($flightId)
        {
            $passengersModel = new PassengersModel();
            $passengers = $passengersModel->getPassengers($flightId);
            //$passengersArray = array();
            return $passengers;
//            foreach ($passengers as $passenger) {
//                $showPassenger = new stdClass();
//                $showPassenger->flightName = $passenger->flightName;
//                $showPassenger->lastname = $passenger->lastname;
//                $showPassenger->firstname = $passenger->firstname;
//                $passengersArray[] = $showPassenger;
//
//            }
//            return $passengersArray;

            //print_r($passengers);
//            foreach ($passengers as $passenger)
//            {
//
//            }




        }


}
