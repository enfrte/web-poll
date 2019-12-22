<?php
  require 'vendor/autoload.php'; // point to composer's autoloader
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    html, body {
      width: 100%;
      height: 100%;
      margin: 0;
    }
    body {
      background-color: pink;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }
  </style>
  <link rel="stylesheet" href="public/css/web-poll.css">
</head>
<body>
  <?php
    // For demo purposes, this is in a complete page. To embedd in another app, you can omit the page markup, but remember to link the JS.
    require 'main.php';
  ?>
  <div id="debug"></div>
  <script src="public/js/poll-vote.js"></script>
</body>
</html>