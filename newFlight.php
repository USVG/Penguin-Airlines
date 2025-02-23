<?php

//session_start();

include "connection.php";
include "ifSessionHeader.php";



$is_admin = $_SESSION["is_admin"];
if($is_admin == 1){
    $query = $conn->prepare("SELECT * FROM airports");
    $query->execute();
    $airports = $query->fetchAll();


}else{
    header("Location: index.php");
}


?>

<html>

<body>

    <div class="content">

        <h1 align="center">Add New Flight</h1>

        <p align="center">Fill in the fields below and click "Add Flight" to add a new flight</p> <br><br><br>

        <form action="saveNewFlight.php" method="post" align="center">


            <label for="from_Airport">Origin of Flight: </label>
            <select name="from_Airport">

                <?php foreach($airports as $airport): ?>

                    <option value="<?= $airport['id'];?>"><?= $airport['name'];?>, <?= $airport['location'];?></option>

                <?php endforeach; ?>

                ?>

            </select>
            <br><br>

            <label for="to_Airport">Destination of Flight: </label>
            <select name="to_Airport">


                <?php foreach($airports as $airport): ?>

                    <option value="<?= $airport['id'];?>"><?= $airport['name'];?>, <?= $airport['location'];?></option>

                <?php endforeach; ?>

                ?>

            </select>
            <br><br>

            <label for="departure_datetime">Departure Date:</label>
            <input type="datetime-local" id="departure_datetime" name="departure_datetime"> <br><br>

            <label for="return_datetime">Return Date:</label>
            <input type="datetime-local" id="return_datetime" name="return_datetime"> <br><br>

            <label for="number_of_seats">Number of Seats:</label>
            <input type="number" id="number_of_seats" name="number_of_seats" placeholder="Enter the number of seats available" min="0"><br><br>

            <label for="price">Base Price:</label>
            <input type="number" id="price" name="price" placeholder="Enter a number (£)" min="0" step=".01"> <br><br>

            <label for="price">One Way?</label>
            <select name="one_way_status">
                    <option value="FALSE">No</option>
                    <option value="TRUE">Yes (No return date)</option>
            </select> <br> <br>

            <input type="submit" name="submitBtn" value="Add Flight">
        </form>

    </div>

</body>

</html>
<?php include "footer.php"?>