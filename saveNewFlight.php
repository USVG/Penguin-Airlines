<?php

//session_start();


include "connection.php";

include "ifSessionHeader.php";
?>


<html>
<body>

<div class="container" style="background-color: white;">

    <?php

    if(isset($_POST['submitBtn'])){
        $FromAirport = $_POST['from_Airport'];
        $ToAirport = $_POST['to_Airport'];
        $departureDateTime=$_POST['departure_datetime'];
        $returnDateTime=$_POST['return_datetime'];
        $numOfSeats = $_POST['number_of_seats'];
        $price = $_POST['price'];
        $oneWayStatus = $_POST['one_way_status'];
    } else {
      echo "<br><br><br><input href='newFlight.php' type='submit' class='btn' value='Back to flight creation'>";
      echo "<br><h2><strong>ERROR:</strong> Form transmission failure<h2>";
      exit();
    }


    if ($oneWayStatus == "TRUE") {
      $oneWayStatus = 1;
      $returnDateTime = NULL;
    } else {
      $oneWayStatus = 0;
    }

    if($numOfSeats == "" || $price == "") {
      echo "<br><br><br><input onclick='history.go(-1);' type='submit' class='btn' value='Back to flight creation'>";
      echo "<br><h2><strong>ERROR:</strong> You did not fill out all of the required fields<h2>";
      exit();
    }

    if($FromAirport == $ToAirport) {
      echo "<br><br><br><input onclick='history.go(-1);' type='submit' class='btn' value='Back to flight creation'>";
      echo "<br><h2><strong>ERROR:</strong> The flight origin and destination have been set to the <i>same</i> place<h2>";
      exit();
    }

    if (((empty(date_parse($returnDateTime)['year'])) || (empty(date_parse($departureDateTime)['year']))) && $oneWayStatus == 0) {
        echo "<br><br><br><input onclick='history.go(-1);' type='submit' class='btn' value='Back to flight creation'>";
        echo "<br><h2><strong>ERROR:</strong> You must set a departure <i>and</i> return date when creating two way flights<h2>";
        exit();
    }

    if (($departureDateTime > $returnDateTime) && $oneWayStatus == 0) {
      echo "<br><br><br><input onclick='history.go(-1);' type='submit' class='btn' value='Back to flight creation'>";
      echo "<br><h2><strong>ERROR:</strong> The return date is set <i>before</i> the departure date<h2>";
      exit();
    }


        //MAIN SQL STATEMENT FOR FLIGHT
    $query="INSERT INTO flights (id, origin_id, destination_id, departure_datetime, return_datetime, number_of_seats, price, one_way_status) VALUES (NULL,:originId, :destinationId, :departureDateTime, :returnDateTime, :number_of_seats, :price, :one_way_status)";
    $stmt=$conn->prepare($query);
    $stmt->bindValue(':originId', $FromAirport);
    $stmt->bindValue(':destinationId', $ToAirport);
    $stmt->bindValue(':departureDateTime', $departureDateTime);
    $stmt->bindValue(':returnDateTime', $returnDateTime);
    $stmt->bindValue(':number_of_seats', $numOfSeats);
    $stmt->bindValue(':price', $price);
    $stmt->bindValue(':one_way_status', $oneWayStatus);


    if($stmt->execute()){
        $query2="SELECT * FROM flights ORDER BY id DESC LIMIT 1";
        $result = $conn->query($query2);
        $newFlightResult = $result->fetch();
        $newFlightId = $newFlightResult["id"];

        $query2="SELECT f.*, lo.name AS origin_name, lo.location AS origin_location, ld.name AS destination_name, ld.location AS destination_location
        FROM flights f JOIN
             airports lo
             ON f.origin_id = lo.id JOIN
             airports ld
             ON f.destination_id = ld.id
             WHERE f.origin_id = $FromAirport AND f.destination_id = $ToAirport";
        $result = $conn->query($query2);
        $originResult = $result->fetch();

        echo "<h2>Successfully added the details for Flight ID: $newFlightId.</h2>";
        echo "<p>Origin: ID-{$newFlightResult['origin_id']}, {$originResult['origin_name']}, {$originResult['origin_location']}</p>";
        echo "<p>Destination: ID-{$newFlightResult['destination_id']}, {$originResult['destination_name']}, {$originResult['destination_location']}</p>";
        echo "<h3>Departure</h3>";
        echo "<p>Datetime: {$newFlightResult['departure_datetime']}</p>";
        echo "<h3>Return</h1>";
        echo "<p>Datetime: {$newFlightResult['return_datetime']}</p>";
        echo "<h3>Other Details</h3>";
        echo "<p>Number of Seats: {$newFlightResult['number_of_seats']}</p>";
        echo "<p>Base Price: £{$newFlightResult['price']}</p>";
        if ($oneWayStatus == 1) {
          echo"<p>One Way: Yes</p>";
        } else {
          echo "<p>One Way: No</p>";
        }
    } else{
        echo"<p>There was a problem inserting the data.</p>";
    }


  ?>


<?php

 ?>
