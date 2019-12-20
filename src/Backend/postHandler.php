<?php 

use WebPoll\Backend\Ballot;

if(isset( $_POST['vote'] )) {
  $ballot = new Ballot($_POST['vote']);
  //var_dump($ballot);
} else {
  echo 'Data not received';
  //print_r($_POST);
}
