<?php

//error_reporting(E_ALL);

include "controller/FlightsController.php";
include "services/DatabaseService.php";
include "model/DBGatewayModel.php";
include "model/FlightsModel.php";
include "view/JsonView.php";

define("DBHost", "localhost");
define("DBName", "flights");
//define("charset", "utf8");
define("DBPassword", "");
define("DBUserName", "root");