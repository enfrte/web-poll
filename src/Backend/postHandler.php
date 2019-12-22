<?php 
require '../../vendor/autoload.php'; // If you link directly to your postHandler.php, PHP will not be aware of the composer autoloader because it didn't execute index.php
use WebPoll\Backend\Ballot;

if(isset( $_POST['vote'] )) {
  $ballot = new Ballot($_POST['vote']);
  //var_dump($ballot);
} else {
  echo 'Data not received';
  //print_r($_POST);
}
