<?php 
require '../../vendor/autoload.php'; // notify php of autoload.php. Can be removed if RenderTemplates works better.
use WebPoll\Backend\Ballot;

if(isset( $_POST['vote'] )) {
  $ballot = new Ballot($_POST['vote']);
  //var_dump($ballot);
} else {
  echo 'Data not received';
  //print_r($_POST);
}
