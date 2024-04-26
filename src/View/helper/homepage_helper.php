<?php

use src\Model\Query;

require '../src/Model/Query.php';

session_start();
Query::connect();
$results = Query::showResults();
$max_player_added = false;
$max_strike_rate = 0;
$man_of_the_match_id = 0;
if(mysqli_num_rows($results) >= 11){
  $max_player_added = true;
}
if(isset($_POST['add-player'])){
  $player_name = $_POST['player_name'];
  $balls = $_POST['ball-count'];
  $runs = $_POST['run-count'];
  Query::addPlayerResults($player_name,$balls,$runs);
  $success_message = 'Player added successfully!';
  header('Location: /');
}
$man_of_the_match = [];

