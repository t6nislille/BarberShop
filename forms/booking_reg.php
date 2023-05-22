<?php

$port = 3307;
$host = "localhost";
$dbname = "barber_services";
$username = "d113909sa442372";
$password = "Pruunkoer123";

$conn = new mysqli($host, $username, $password, $dbname, $port);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['send'])) {

  $service = mysqli_real_escape_string($conn, $_POST["service"]);
  $price = mysqli_real_escape_string($conn, $_POST["price"]);
  $name = mysqli_real_escape_string($conn, $_POST["name"]);
  $email = mysqli_real_escape_string($conn, $_POST["email"]);
  $time1 = mysqli_real_escape_string($conn, $_POST["time"]);
  $day1 = mysqli_real_escape_string($conn, $_POST["day"]);

  $time = date('H:i:s', strtotime($time1));
  $day = date('Y-m-d', strtotime($day1));

  $sql = "INSERT INTO bookings (service, price, name, email, day, time)
          VALUES ('$service', '$price', '$name', '$email', '$day', '$time')";

  function function_alert($message) {
    echo "<script>alert('$message');</script>";
  }

  if ($conn->query($sql) === TRUE) {
    function_alert("New booking for " . $name . " (email: " . $email . ") at " . $day . " at " . $time . " o'clock.");
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();

  header("Location: ../index.html");
  exit();
}
?>
