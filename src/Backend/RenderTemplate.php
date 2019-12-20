<?php 
namespace WebPoll\Backend;

// think about using aas static class
// https://www.daggerhart.com/simple-php-template-class/
// https://www.daggerhart.com/create-simple-php-templating-function/
class RenderTemplate {
  private $templatePath;
  
  public function __construct(String $filePath = null)
  {
    // check files exist !file_exists($filePath)
    $this->templatePath = $filePath;
  } 
  
  public function render()
  {
    require $templatePath;
  }
}