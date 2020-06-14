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


}
