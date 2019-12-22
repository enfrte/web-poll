<?php 
namespace WebPoll\Backend;

/**
 * Validates an email address
 */
class VoterValidation {
  public $errors;
  private $voterIpAddress;
  private $voterIpAddressDb;

  public function __construct() {
    $this->voterIpAddress = $_SERVER['REMOTE_ADDR'];     
    // echo "Debug: Your IP Address is $this->voterIpAddress <br />"; exit();
    $this->voterIpAddressDb = '../Database/ip-address-db.log';
    $this->checkDuplicateIpAddress();
  } 

  public function checkDuplicateIpAddress() {
    // Check ip address has not already voted
    $dbCheck = file_get_contents($this->voterIpAddressDb);
    if (preg_match("/$this->voterIpAddress/", $dbCheck)) {
      $this->addError('duplicateIpAddress', 'Your IP Address has already voted in this poll.');
      // render errors view
    }
  }

  private function addError($key, $value) {
    $this->errors[$key] = $value;
  }

}