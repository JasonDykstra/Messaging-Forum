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

  $sender = $_GET["sender"];
  $recipient = $_GET["to"];
  $subject = $_GET["subject"];
  $body = $_GET["body"];

  $getSenderID = "SELECT * FROM users WHERE username = '$sender'";
  $getRecipientID = "SELECT * FROM users WHERE username = '$recipient'";

  $senderStatement = $conn -> query($getSenderID);
  $recipientStatement = $conn -> query($getRecipientID);

  $senderRow = $senderStatement -> fetch();
  $recipientRow = $recipientStatement -> fetch();

  $senderID = $senderRow["userID"];
  $recipientID = $recipientRow["userID"];

  $send = "INSERT INTO messages(fromUserID, subject, body) values('$senderID', '$subject', '$body')";
  $conn -> exec($send);

  $messageID = $conn -> lastInsertId();

  $updateMessageRecipients = "INSERT INTO messageRecipients(messageID, toUserID) values('$messageID', '$recipientID')";
  $conn -> exec($updateMessageRecipients);

  echo "Sent message successfully!";

}
catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>
