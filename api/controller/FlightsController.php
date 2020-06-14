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

                    $this->jsonView->output($this->showPassengers($flightId));
                    break;



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
