<?php

$port = 3307;
$host = "localhost";
$dbname = "barber_services";
$username = "d113909sa442372";
$password = "Pruunkoer123";
$adminEmail = "tonislille@gmail.com"; // Replace with your email address

$conn = mysqli_connect($host, $username, $password, $dbname, $port);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['send'])) {

  $product = $_POST["product"];
  $price = $_POST["price"];
  $name = $_POST["name"];
  $email = $_POST["email"];

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "INSERT INTO purchases (product, price, name, email)
  VALUES ('$product', '$price', '$name', '$email')";

  if (mysqli_query($conn, $sql)) {
    // Successful query execution
    sendNotificationEmail($adminEmail, $name, $email, $product);
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  mysqli_close($conn);
  echo "<script> location.href='./index.html'; </script>";
}

function sendNotificationEmail($adminEmail, $name, $email, $product) {
  $to = $adminEmail;
  $subject = "New Purchase Notification";
  $message = "A new purchase has been made.\n\nName: $name\nEmail: $email\nProduct: $product";
  $headers = "From: tonislille@gmail.com"; // Replace with your email address

  if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully.";
  } else {
    echo "Failed to send email.";
  }
}

?>
