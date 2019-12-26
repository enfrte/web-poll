<?php 
namespace WebPoll\Backend;

class Ballot {
  private $voterIpAddressDb = '../Database/ip-address-db.log';
  private $ipAddress;
  private $voteChoice; 
  private $voteCandidates; 
  private $voteTable = [];
  private $voteTableFile = '../Database/poll-results.log';

  public function __construct(String $voteChoice, String $voteCandidates) {
    $this->ipAddress = $_SERVER['REMOTE_ADDR']; 
    $this->voteChoice = $voteChoice; 
    $this->voteCandidates = \json_decode($voteCandidates); 
    $jsonData = file_get_contents($this->voteTableFile);
    $phpData = \json_decode($jsonData, TRUE);
    if (count($phpData) > 0) {
      $this->voteTable = $phpData; // else use default value
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
    $this->registerAllCandidates();
    if (array_key_exists($candidate, $this->voteTable)) {
      $this->voteTable[$candidate]++;
    } 
    $this->storeVote();
    return true;
  }

  // Registers all candidates regardless of whether they have recieved a vote or not. Needed for visibility in the results screen.
  private function registerAllCandidates() {
    foreach ($this->voteCandidates as $key => $candidate) {
      if (!array_key_exists($candidate, $this->voteTable)) {
        $this->voteTable[$candidate] = 0;
      }
    }
  }

  private function storeVote() {
    $jsonData = \json_encode($this->voteTable);
    $f = fopen($this->voteTableFile, "w") or die("Can't open poll-results.log");
    fputs($f, $jsonData);
    fclose($f);
  }

}