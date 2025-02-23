<?php
include "ifSessionHeader.php";
include "connection.php";

if(isset($_POST['submitBtn'])){
    $economyQuantity = $_POST['economy_quantity'];
    $businessQuantity = $_POST['business_quantity'];
    $firstClassQuantity = $_POST['firstclass_quantity'];
    $flightId = $_POST['flight_id'];
    $cardNumber = $_POST['card_number'];
    $cardName = $_POST['card_name'];
    $cardCVC = $_POST['card_cvc'];
} else {
   echo "<br><br><br><input href='index.php' type='submit' class='btn' value='Back to flight creation'>";
   echo "<br><h2><strong>ERROR:</strong> Form transmission failure<h2>";
   exit();
}
$userId = $_SESSION['id'];

if (($cardNumber == "") || ($cardName == "") || ($cardCVC == "")) {
  echo "<br><br><br><input onclick='history.go(-3);' type='submit' class='btn' value='Back to Flight Search'>";
  echo "<br><h2><strong>PAYMENT ERROR:</strong> You did not complete the payment form<h2>";
  exit();
}

function insertBookingForQuantity($quantity, $flightId, $userId, $seatTypeId) {
  include "connection.php";
  for ($x = 0; $x < $quantity; $x++) {
    $query="INSERT INTO bookings (id, flightID, userID, seat_typeID) VALUES (NULL, :flightId, :userId, :seat_typeID)";
    $stmt=$conn->prepare($query);
    $stmt->bindValue(':flightId', $flightId);
    $stmt->bindValue(':userId', $userId);
    $stmt->bindValue(':seat_typeID', $seatTypeId);
    $stmt->execute();
  }
}

if ($economyQuantity == "" || $economyQuantity == "0") {

} else {
  insertBookingForQuantity($economyQuantity, $flightId, $userId, 1);
}
if ($businessQuantity == "" || $businessQuantity == "0") {

} else {
  insertBookingForQuantity($businessQuantity, $flightId, $userId, 2);
}
if ($firstClassQuantity == "" || $firstClassQuantity == "0") {

} else {
  insertBookingForQuantity($firstClassQuantity, $flightId, $userId, 3);
}

?>

<br><br><br>
<div class ="container"; style="background-color:white;" style="text-align:center">
  <h1 style="text-align:center;"> Payment Confirmed<h1>
  <a href="currentBookings.php"><input type="button" class="btn btn-primary" value="View Bookings" style="width: 300px; margin: 0 auto;"></input></a>
</div>

<?php include "footer.php"; ?>
