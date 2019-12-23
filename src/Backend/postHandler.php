<?php 
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
require '../../vendor/autoload.php'; // If you link directly to your postHandler.php, PHP will not be aware of the composer autoloader because it didn't execute index.php

use WebPoll\Backend\Ballot;
use WebPoll\Backend\VoterValidation;

$result = [];

$validateVoter = new VoterValidation;
$errors = $validateVoter->errors; 
if ($errors) {
  foreach ($errors as $key => $value) {
    $result['errors'] = [$key => $value];
    $result['success'] = false;
  }
  sendResultJson($result);
}

if(!isset( $_POST['vote'] )) {
  $result['errors'] = ['postError' => 'Vote was not received.'];
  $result['success'] = false;
  sendResultJson($result);
}
$ballot = new Ballot($_POST['vote']);

if (!$ballot->logIpAddress()) {
  $result['errors'] = ['ipAddressLogError' => 'Could not submit vote. There was a problem with your registration.'];
  $result['success'] = false;
  sendResultJson($result);
}

if ($ballot->registerVote()) {
  $result['success'] = true;
  sendResultJson($result);
}

function sendResultJson(array $result) {
  $resultJson = json_encode($result);
  echo $resultJson;
  exit;
}
