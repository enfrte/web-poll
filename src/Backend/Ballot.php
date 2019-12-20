<?php 
namespace WebPoll\Backend;

class Ballot {
  private $voterIpAddressDb;
  private $ipAddress;
  private $voteChoice; 

  public function __construct(String $voteChoice) {
    $this->voterIpAddressDb = 'ip-address-db.log';
    $this->ipAddress = $_SERVER['REMOTE_ADDR']; 
    $this->voteChoice = $voteChoice; 
    return 'ballot ok';
  }

  private function logIpAddress()
  {
    $ipAddressDb = fopen($this->voterIpAddressDb, 'a') or die("Can't open pollIp.log");
    $insertIpAddress = "$this->ipAddress\n";
    fwrite($ipAddressDb, $insertIpAddress);
    fclose($ipAddressDb);
  }
}
