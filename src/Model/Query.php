<?php

namespace src\Model;

use mysqli;
use mysqli_result;
require 'creds.php';

/**
 * Query class initiates a database connection to mysql database server, adds
 * new player, checks if the username is already in database
 * and returns password to a specific username.
 */
class Query {

  /**
   * Database connection.
   */
  private static mixed $conn = null;

  /**
   * Connects to mysql database. If the connection is successful, returns true
   * else returns false.
   *
   * @return bool
   *   If connection is successful , returns true, else returns false.
   */
  public static function connect():bool {
    global $server_host, $db_username, $db_password, $dbname;

    // Connection.
    self::$conn = new mysqli(
      $server_host,
      $db_username,
      $db_password,
      $dbname
    );

    // For checking if connection is successful or not.
    return !self::$conn->connect_error;
  }


  /**
   * Gets password of the user. Returns password as a string. If a email
   * doesn't exist in the database, returns false.
   *
   * @param string $email
   *
   * @return string|null
   *   Returns password as string. Returns null if username doesn't exist in
   *  the database.
   */
  public static function getUserPassword(string $email):?string {
    if (self::checkUser($email)) {
      $sql = "SELECT password FROM users WHERE email = '$email'";
      $res = mysqli_query(self::$conn, $sql);
      return mysqli_fetch_assoc($res)['password'];
    }
    return null;
  }

  /**
   * Checks if the username already exists in the database or not.
   *
   * @param string $email
   *
   * @return bool
   *   Returns true if user already exists in the database, returns false if
   *   username doesn't exist in a database.
   */
  public static function checkUser(string $email):bool {
    $sql = "SELECT email FROM users WHERE email = '$email'";
    $res = mysqli_query(self::$conn, $sql);
    return !mysqli_fetch_assoc($res) == null;
  }

  /**
   * Adds new player.
   *
   * @param string $playerName
   *   Player name.
   * @param int $balls
   *   Number of balls the player faced.
   * @param int $runs
   *   Number of runs the player made.
   *
   * @return bool
   *   Returns true if adding a player to the database is successful, else
   * returns false.
   */
  public static function addPlayerResults(string  $playerName, int $balls,
                                          int $runs):bool {
    $sql = "INSERT INTO player_result(player_name, balls, runs) VALUE ('$playerName',
                                                '$balls', '$runs')";
    return mysqli_query(self::$conn, $sql);
  }

  /**
   * Returns all player details.
   *
   * @return mysqli_result|bool
   *   Returns player list.
   */
  public static function showResults(): mysqli_result|bool
  {
    $sql = 'SELECT * FROM player_result';
    return mysqli_query(self::$conn, $sql);
  }

  public static function removePlayer(int $id):bool {
    $sql = "DELETE FROM player_result WHERE id = '$id'";
    return mysqli_query(self::$conn, $sql);
  }


  /**
   * Gets details of the Man of the match using id.
   *
   * @param int $id
   *   Id of man of the match
   *
   * @return array Returns the user details.
   *   Returns the player details.
   */
  public static function getManOfTheMatch(int $id): array {
    $sql = "SELECT * FROM player_result where id = '$id'";
    $res = mysqli_query(self::$conn, $sql);
    return mysqli_fetch_assoc($res);
  }

}
