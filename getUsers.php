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

  echo "Connected successfully <br>";

  $getUsers = "SELECT username, firstName, lastName FROM users";

  $statement = $conn -> query($getUsers);

  //display table of results
  print "<style> table, th, td {border: 1px solid black;} </style>";
  print "<table><tr><th>Username</th><th>First Name</th><th>Last Name</th></tr>";

  foreach ($statement as $row) {
    print "<tr>";
    print "<td>" .  $row['username'] .  "</td>";
    print "<td>" .  $row['firstName'] .  "</td>";
    print "<td>" .  $row['lastName'] .  "</td>";
    print "</tr>";
  }
  print "</table>";

}
catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
