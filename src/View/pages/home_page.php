<?php

use src\Model\Query;

require '../src/View/helper/homepage_helper.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Homepage</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="bg-info-subtle">
<div class="container col-6">
  <div class="row d-flex justify-content-end">
    <div class="col ">
      <?php
      if(isset($_SESSION['logged_in'])){
        ?>
        <a class="btn btn-primary" href="/logout">Logout</a>
      <?php
      }else{
        ?>
        <a class="btn btn-primary" href="/login">loginy</a>
      <?php
      }
      ?>
    </div>
  </div>
</div>
<div class="container-sm mt-5 col-6">
  <?php
  if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
    if(isset($max_player_added) && !$max_player_added){
      ?>
      <form method="post" action="/" class="row g-3">
        <div class="col-auto">
          <label for="name" class="visually-hidden"></label>
          <input type="text" name="player_name" class="form-control" id="name"
                 placeholder="Player Name">
        </div>
        <div class="col-auto">
          <label for="ball-count" class="visually-hidden"></label>
          <input type="number" name="ball-count"  class="form-control" id="ball-count"
                 placeholder="Ball faced">
        </div>
        <div class="col-auto">
          <label for="run-count" class="visually-hidden"></label>
          <input type="number" name="run-count" class="form-control"
                 id="run-count"
                 placeholder="Runs">
        </div>
        <div class="col-auto">
          <button type="submit" name="add-player" class="btn btn-primary
      mb-3">Add</button>
        </div>
      </form>
      <br>
      <br>
      <?php
    }
  }
  ?>

  <table class="table table-success table-striped-columns text-center">
    <thead>
    <tr>
      <th>ID</th>
      <th>Player Name</th>
      <th>Ball Faced</th>
      <th>Runs Made</th>
      <th>Strike Rate</th>
      <?php
      if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
      ?>
        <th>Actions</th>
        <?php
      }
      ?>
    </tr>
    </thead>
    <tbody>
    <?php
      $i = 1;
      while($result = mysqli_fetch_assoc($results)) {
        $strike_rate = number_format((float)(($result['runs']/ $result['balls']) * 100), 2, '.', '');
        if($strike_rate > $max_strike_rate){
          $max_strike_rate = $strike_rate;
          $man_of_the_match_id = $result['id'];
        }
        ?>
        <tr>
        <td><?=$i++ ?></td>
        <td><?=$result['player_name'] ?></td>
        <td><?=$result['balls'] ?></td>
        <td><?=$result['runs'] ?></td>
        <td><?=$strike_rate ?></td>
          <?php
          if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
          ?>
          <td>
          <a href="#">Remove</a>
          <br>
          <a href="#">Edit</a>
          </td>
          <?php
          }
          ?>
        </tr>

      <?php
        $man_of_the_match = Query::getManOfTheMatch($man_of_the_match_id);
      }
    ?>
    </tbody>
  </table>
    <?php
      if(!isset($_SESSION['logged_in'])){
        ?>
        <button class="btn btn-primary" id="man-btn" name="man"
                type="submit">Man of the
          Match</button>
        <?php
      }
    ?>
    <table id="man-table" class="visually-hidden table table-success mt-4">

      <tbody>
      <tr>
        <td>Name</td>
        <td><?=$man_of_the_match['player_name'] ?></td>
      </tr>
      <tr>
        <td>Balls Faced</td>
        <td><?= $man_of_the_match['balls'] ?></td>
      </tr>
      <tr>
        <td>Runs Made</td>
        <td><?= $man_of_the_match['runs'] ?></td>
      </tr>
      <tr>
        <td>Strike Rate</td>
        <td><?=$max_strike_rate ?></td>
      </tr>
      </tbody>
    </table>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js">
</script>
<script src="js/man_of_match.js"></script>
</body>
</html>
