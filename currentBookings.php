<?php

include "ifSessionHeader.php";
include "connection.php";

$userId = $_SESSION['id'];
$firstName = $_SESSION['first_name'];
$lastName = $_SESSION['last_name'];
?>

<div class="container" style="background-color:lightgray">

<?php
echo "<br><h1 style='text-align:center'> Current Bookings for $firstName $lastName</h1><br>";

$query = $conn->prepare("SELECT bookings.id, bookings.flightID, seat_type.name, flights.departure_datetime, flights.return_datetime, flights.one_way_status, a1.name AS origin_name, a1.location AS origin_location, a2.name AS destination_name, a2.location AS destination_location
FROM bookings, seat_type, flights, airports a1, airports a2
WHERE bookings.userID = :id
AND bookings.seat_typeID = seat_type.id
AND bookings.flightID = flights.id
AND flights.origin_id = a1.id
AND flights.destination_id = a2.id");
$query->bindValue(':id', $userId);
$query->execute();
$bookings=$query->fetchAll();

if ($bookings){
  foreach ($bookings as $booking) {
    echo"<table width='100%'>";
    echo"<tbody>";
    echo"<tr>";
    echo"<td style='width: 30%; vertical-align: top; background: gray;'>";
    echo"<h4>{$booking['name']} Ticket</h4>";
    echo"</td>";
    echo"<td style='width: 30%; vertical-align: top; background: gray;'>";
    echo"<h4></h4>";
    echo"</td>";
    echo"<td style='width: 30%; vertical-align: top; background: gray; text-align:right;'>";
    echo"<h4>Booking ID:{$booking['id']} &ensp;</h4>";
    echo"</td>";
    echo"</tr>";
    echo"<tr style='background: white;'>";
    echo"<td>";
    echo"<br>";
    echo"<strong>Penguin Airlines Flight</strong><br><p style='color:blue; '>ID{$booking['flightID']}</p>";
    echo"</td>";
    echo"<td>";
    echo"<br><p><strong>{$booking['origin_name']}</strong></p>";
    echo"<p>{$booking['origin_location']}</p>";
    echo"<p>Depart: {$booking['departure_datetime']}</p>";
    echo"</td>";
    echo"<td>";
    echo"<br><p><strong>{$booking['destination_name']}</strong></p>";
    echo"<p>{$booking['destination_location']}</p>";
    if ($booking['one_way_status'] == 1) {
      echo"<p>One Way Flight</p>";
    } else {
      echo"<p>Return: {$booking['return_datetime']}</p>";
    }
    echo"</td>";
    echo"</tr>";
    echo"</tbody>";
    echo"</table> <br>";
  }
} else {
  echo "<h4 style='text-align:center;'>You do not have any bookings</h4><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
}


?>

</div>


<?php

include "footer.php";

 ?>
