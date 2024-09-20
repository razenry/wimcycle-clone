<?php 

// Include the initialization file which sets up necessary configurations and dependencies
require_once 'init.php';

// Set the timezone to Indonesian standard time using the DateHelper class
DateHelper::setIndonesianTimeZone();

// Instantiate the main application class
$app = new App();