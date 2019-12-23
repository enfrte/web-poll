<?php 
namespace WebPoll\Backend;

// Calculate votes.
class Result {
  public function getResults() {
    $results = \file_get_contents('../Database/poll-results.log');
    return $results;
  }
}
