<?php 
namespace WebPoll\Backend;

class Ballot {
  private $voterIpAddressDb;
  private $ipAddress;
  private $voteChoice; 

  public function __construct(String $voteChoice) {
    $this->voterIpAddressDb = '../Database/ip-address-db.log';
    $this->ipAddress = $_SERVER['REMOTE_ADDR']; 
    $this->voteChoice = $voteChoice; 
  }

  public function logIpAddress() {
    $ipAddressDb = fopen($this->voterIpAddressDb, 'a') or die("Can't open ip-address-db.log");
    $insertIpAddress = "$this->ipAddress\n";
    fwrite($ipAddressDb, $insertIpAddress);
    fclose($ipAddressDb);
    return true;
  }

  public function registerVote() {
    $voteDb = '../Database/poll-results.log';

  }

}
