<?php
include "connection.php";

include "ifSessionHeader.php";
?>

<div class = "container">

    <?php

      if(isset($_GET['submitBtn'])){
        $FromAirport = $_GET['from_Airport'];
        $ToAirport = $_GET['to_Airport'];
        $departureDate=$_GET['departure_date'];
        $returnDate=$_GET['return_date'];
        $sortResults = $_GET['sort_results'];
        $oneWayStatus = $_GET['one_way_status'];
      } else {
        echo "<br><br><br><a href='searchFlights.php'><input type='submit' class='btn' name='submitBtn' value='Back to flight search'></a>";
        echo "<br><h2><strong>ERROR:</strong> Form transmission failure<h2>";
      }

      if ($oneWayStatus == "TRUE") {
        $oneWayStatus = 1;
        $returnDateTime = NULL;
      } else {
        $oneWayStatus = 0;
      }

      echo "$departureDate";

      $query = "SELECT f.*, lo.name AS origin_name, lo.location AS origin_location, ld.name AS destination_name, ld.location AS destination_location
      FROM flights f JOIN
           airports lo
           ON f.origin_id = lo.id JOIN
           airports ld
           ON f.destination_id = ld.id
           WHERE f.origin_id = $FromAirport AND f.destination_id = $ToAirport AND f.departure_datetime LIKE '$departureDate%' AND f.return_datetime LIKE '$returnDate%' ";

      if ($oneWayStatus == 1) {
        $query .= "AND f.one_way_status = 1 ";
      }

      if ($sortResults == 1) {
        $query .= "ORDER BY f.departure_datetime ASC";
      } else if ($sortResults == 2){
        $query .= "ORDER BY f.departure_datetime DESC";
      } else if ($sortResults == 3){
        $query .= "ORDER BY f.price ASC";
      } else if ($sortResults == 4){
        $query .= "ORDER BY f.price DESC";
      }


      $stmt=$conn->prepare($query);
      $resultset = $conn->query($query);
      $flights = $resultset->fetchAll();

      ?>
      <br><br>
      <div class="container" style="background-color:#DDDDDD;">
      <h2><strong>Flight Search Results</strong></h2>
      <a href="searchFlights.php"><input type='submit' class='btn' name='submitBtn' value='Back to flight search'></a>
      <p>.</p>
      <?php
      if($flights){
        foreach ($flights as $flight) {
            echo "<li style='margin-bottom:15px; text-align:left; background-color:white; list-style-type: none;'>";
            echo "<h3 style='color: black; padding:5px;'><strong>{$flight["origin_name"]}, {$flight["origin_location"]}</strong> to <strong>{$flight["destination_name"]}, {$flight["destination_location"]}</strong><br></h3>";
            echo "<h4>&nbsp; Departure Date: <i>{$flight["departure_datetime"]} </i></h4>";
            if ($oneWayStatus == 1) {
              echo "<h4>&nbsp; One-Way Flight </i></h4>";
            } else {
              echo "<h4>&nbsp; Return Date: <i>{$flight["return_datetime"]} </i></h4>";
            }
            echo "<a href='flightInformation.php?id={$flight["id"]}'><input type='submit' class='btn btn-primary' name='submitBtn' value='View Flight'></a>";
            echo "<input type='submit' class='btn' name='submitBtn' value='Base Price: £{$flight["price"]}'>";
            echo "</li>";
        }
      } else {
        echo "<h5>Cannot find any flights for this search</h5>";
      }
    ?>
  </div>
</div>

<?php
include "footer.php";
?>
