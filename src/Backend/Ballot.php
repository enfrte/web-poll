<?php 
namespace WebPoll\Backend;

class Ballot {
  private $voterIpAddressDb = '../Database/ip-address-db.log';
  private $ipAddress;
  private $voteChoice; 
  private $voteTable = [];
  private $voteTableFile = '../Database/poll-results.log';

  public function __construct(String $voteChoice) {
    $this->ipAddress = $_SERVER['REMOTE_ADDR']; 
    $this->voteChoice = $voteChoice; 
    $jsonData = file_get_contents($this->voteTableFile);
    $phpData = \json_decode($jsonData, TRUE);
    if (count($phpData) > 0) {
      $this->voteTable = $phpData;
    }
  }

  public function logIpAddress() {
    if (!isset($this->ipAddress)) {
      return false;
    }
    $ipAddressDb = fopen($this->voterIpAddressDb, 'a') or die("Can't open ip-address-db.log");
    $insertIpAddress = "$this->ipAddress\n";
    fwrite($ipAddressDb, $insertIpAddress);
    fclose($ipAddressDb);
    return true;
  }

  public function registerVote() {
    $candidate = $this->voteChoice;
    if (array_key_exists($candidate, $this->voteTable)) {
      $this->voteTable[$candidate]++;
    } else {
      $this->voteTable[$candidate] = 1;
    }
    $this->storeVote();
    return true;
  }

  private function storeVote() {
    $jsonData = \json_encode($this->voteTable);
    $f = fopen($this->voteTableFile, "w") or die("Can't open poll-results.log");
    fputs($f, $jsonData);
    fclose($f);
  }

}