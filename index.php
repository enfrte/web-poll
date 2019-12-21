<?php
  require 'vendor/autoload.php'; // main entry point
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="src/public/css/web-poll.css">
</head>
<body>
  <?php
    require 'main.php';
  ?>
  <div id="debug"></div>
  <script src="src/public/js/poll-vote.js"></script>
</body>
</html>