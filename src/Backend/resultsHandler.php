<?php 
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
require '../../vendor/autoload.php'; // If you link directly to your postHandler.php, PHP will not be aware of the composer autoloader because it didn't execute index.php

use WebPoll\Backend\Result;

if(isset( $_GET )) {
  $results = new Result();
  echo $results->getResults();
} else { 
  echo 'didnt get it'; 
}
