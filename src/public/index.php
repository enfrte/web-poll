<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Web Poll Example</title>
  <link rel="stylesheet" href="src/public/css/web-poll.css">
</head>
<body>

  <?php 
    require 'src/Frontend/ballot.view.php'; // path is where this file is called from - so web-poll/index.php
    //require $_SERVER['DOCUMENT_ROOT'].'/web-poll/src/Frontend/ballot.view.php';
  ?>

  <script src="src/public/js/poll-vote.js"></script>
</body>
</html>