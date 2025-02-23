<?php

include "connection.php";

$flightId=$_GET['id'];
$query = $conn->prepare("SELECT f.*, lo.name AS origin_name, lo.location AS origin_location, ld.name AS destination_name, ld.location AS destination_location
      FROM flights f JOIN
           airports lo
           ON f.origin_id = lo.id JOIN
           airports ld
           ON f.destination_id = ld.id
           WHERE f.id = :id;");
$query->bindValue(':id', $flightId);
$query->execute();
$flight=$query->fetch();

$query = $conn->prepare("SELECT f.*, lo.name AS origin_name, lo.location AS origin_location, ld.name AS destination_name, ld.location AS destination_location
      FROM flights f JOIN
           airports lo
           ON f.origin_id = lo.id JOIN
           airports ld
           ON f.destination_id = ld.id
           WHERE f.id != $flightId
           ORDER BY RAND() LIMIT 5");
$query->execute();
$randomFlights=$query->fetchAll();

$economyPrice =  "{$flight['price']}";
$businessPrice = 40 + "{$flight['price']}";
$firstClassPrice = 80 + "{$flight['price']}";

include "ifSessionHeader.php";
?>


<div class="container">
    <br><br>
    <div class="row">

        <!-- Article main content -->
        <article class="col-sm-9 maincontent" style="background-color:white;">
            <?php
            if($flight){
                echo "<h2><strong>Details for Flight ID$flightId</strong></h2>";
                echo "<input onclick='history.go(-1);' type='submit' class='btn' value='Back to flight list'>";
                echo "<p></p><p></p>";
            }
            else
            {
                echo "<p>We can't find any flights under this ID.</p>";
            }

            ?>
            <table width="100%">
                <tbody>
                <tr>
                    <td style="width: 30%; vertical-align: top; background: lightgrey;">
                        <h4>Flight</h4>
                    </td>
                    <td style="width: 30%; vertical-align: top; background: lightgrey;">
                        <h4>Depart</h4>
                    </td>
                    <td style="width: 30%; vertical-align: top; background: lightgrey;">
                        <h4>Arrival</h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <br><?php echo"<strong>Penguin Airlines Flight</strong><br><p style='color:blue; '>ID$flightId</p>";?>
                    </td>
                    <td>
                        <?php
                        echo"<br><p><strong>{$flight['origin_name']}</strong></p>";
                        echo"<p>{$flight['origin_location']}</p>";
                        echo "<p>Depart: {$flight['departure_datetime']}</p>";
                        ?></td>
                    <td>
                        <?php
                        echo"<br><p><strong>{$flight['destination_name']}</strong></p>";
                        echo"<p>{$flight['destination_location']}</p>";
                        if ($flight['one_way_status'] == 1) {
                            echo"<p>One Way Flight</p>";
                        } else {

                            echo "<p>Return: {$flight['return_datetime']}</p>";
                        }?>
                    </td>
                </tr>

                <form action="payment.php" method="post">
                </tbody>
            </table>
            <br>
            <h3><strong>TICKET BOOKING </strong></h3>
            <!-- Economy Class -->
            <table style="width:100%; background-color:#E0ffe2;" >
                <tbody>
                <tr>
                    <td style="width:100%; background-color:#869988;"><h4>Economy Class</h4></td>
                </tr>
                <tr>
                    <td><h5 style="width:90%;">Economy class is another term for the airplane’s main cabin, as opposed to premium cabins like business class and first class. Sometimes referred to as coach class, economy class typically makes up the bulk of the seating on a flight. It’s the most simple class, with the fewest amenities.</h5></td>
                </tr>
                <tr>
                    <td><h5>Price Per Ticket: £<?php echo"$economyPrice";?></h5></td>
                </tr>
                <tr>
                    <td><h5>Quantity: <input type="number" id="economy_quantity" name="economy_quantity" min="0" max="10"></input></h5></td>
                </tr>
                </tbody>
            </table>

            <!-- Business Class -->
            <table style="width:100%; background-color:#E0EDFF;" >
                <tbody>
                <tr>
                    <td style="width:100%; background-color:#9da6b3;"><h4>Business Class</h4></td>
                </tr>
                <tr>
                    <td><h5 style="width:90%;">The Business Class cabin has a number of complimentary services and amenities, such as high-quality food and drink, larger and more comfortable seating, a personal workspace, travel kits and more. What's included with a Business Class ticket differs from airline to airline, with some more extravagant than others.</h5></td>
                </tr>
                <tr>
                    <td><h5>Price Per Ticket: £<?php echo"$businessPrice"?></h5></td>
                </tr>
                <tr>
                    <td><h5>Quantity: <input type="number" id="business_quantity" name="business_quantity" min="0" max="10"></input></h5></td>
                </tr>
                </tbody>
            </table>
            <table style="width:100%; background-color:#F1e0ff;" >
                <tbody>
                <tr>
                    <td style="width:100%; background-color:#c1b3cc;"><h4>First Class</h4></td>
                </tr>
                <tr>
                    <td><h5 style="width:90%;">First class is a category of luxury seating on a plane that has more space, comfort, and service than other seats, with amenities ranging from private suites to access to on-board showers.</h5></td>
                </tr>
                <tr>
                    <td><h5>Price Per Ticket: £<?php echo"$firstClassPrice"?></h5></td>
                </tr>
                <tr>
                    <td><h5>Quantity: <input type="number" id="firstclass_quantity" name="firstclass_quantity" min="0" max="10"></input></h5></td>
                </tr>
                </tbody>
            </table>
            <!-- First Class -->
            <br>
            <input type="hidden" name="economy_price" value='<?php echo"$economyPrice"?>'></input>
            <input type="hidden" name="business_price" value='<?php echo"$businessPrice"?>'></input>
            <input type="hidden" name="firstclass_price" value='<?php echo"$firstClassPrice"?>'></input>
            <input type="hidden" name="flight_id" value='<?php echo"$flightId"?>'></input>
            <input type="submit" class ="btn btn-primary" name="submitBtn" value="Go to Checkout" style="float: right; margin-bottom: 20px;">
            </form>
            <p></p>

        </article>



        <!-- Sidebar -->
        <aside class="col-sm-3 sidebar sidebar-right" style="background-color:lightgray;">

            <div class="widget">
                <h3 style="text-align:right;">More Flights</h3>
                <?php
                if($randomFlights){
                    foreach ($randomFlights as $randomFlight) {
                        echo "<li style='margin-bottom:15px; text-align:left; background-color:white; list-style-type: none;'>";
                        echo "<a href='flightInformation.php?id={$randomFlight["id"]}'><h5 style='color: black; padding:5px;'><strong>{$randomFlight["origin_name"]}, {$randomFlight["origin_location"]}</strong> to <strong>{$randomFlight["destination_name"]}, {$randomFlight["destination_location"]}</strong><br></h5>";
                        echo "<h5>&nbsp; Departure Date: <i>{$randomFlight["departure_datetime"]} </i></h5>";
                        if ($randomFlight["return_datetime"] == "") {
                            echo "<h5>&nbsp; One-Way Flight</h5>";
                        } else {
                            echo "<h5>&nbsp; Return Date: <i>{$randomFlight["return_datetime"]} </i></h5>";
                        }
                        echo "<h5>&nbsp; From: £{$randomFlight["price"]}</h5></a>";
                        //echo "<div class='container' style='background-color:blue; align:right; width: 100px; height: 90px;'>yo </div>";
                        echo "<br>";
                        echo "</li>";
                    }
                } else {
                    echo "<h5>Cannot find any flights for this search</h5>";
                }
                ?>
            </div>

        </aside>
        <!-- /Sidebar -->

    </div>
</div>	<!-- /container -->



<?php
include "footer.php";
?>
