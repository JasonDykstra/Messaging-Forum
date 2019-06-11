<?php
//See original: https://www.w3schools.com/php/php_mysql_connect.asp
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "chatLog";


try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);

  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $username = $_GET["username"];
  $password = $_GET["password"];
  $email = $_GET["email"];
  $firstName = $_GET["firstName"];
  $lastName = $_GET["lastName"];

  $addUser = "INSERT INTO users(username, password, email, firstName, lastName) VALUES ('$username', '$password', '$email', '$firstName', '$lastName')";

  //need to use conn -> exec because this sql line doesn't return anything
  $conn->exec($addUser);

  echo "User added";





}
catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
