<?php 
namespace WebPoll\Backend;

class RenderTemplate {
  private $templatePath;
  
  public function __construct(String $filePath = '')
  {
    // check files exist !file_exists($filePath)
    $this->templatePath = $filePath;
    $this->render();    
  } 
  
  public function render()
  {
    require $this->templatePath;
    //require $_SERVER['DOCUMENT_ROOT'].'/web-poll/src/Frontend/test.view.php';
  }
}