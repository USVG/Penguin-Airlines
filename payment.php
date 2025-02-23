<?php include "ifSessionHeader.php";


if($_SESSION["email"] == ""){

    echo '<script>alert("First you must sign in!") </script>';
    echo "<script>window.location.href='loginForm.php';</script>";



}else {

    if (isset($_POST['submitBtn'])) {
        $economyQuantity = $_POST['economy_quantity'];
        $businessQuantity = $_POST['business_quantity'];
        $firstClassQuantity = $_POST['firstclass_quantity'];
        $economyPrice = $_POST['economy_price'];
        $businessPrice = $_POST['business_price'];
        $firstClassPrice = $_POST['firstclass_price'];
        $flightId = $_POST['flight_id'];


    } else {
        echo "<br><br><br><input href='index.php' type='submit' class='btn' value='Return'>";
        echo "<br><h2><strong>ERROR:</strong> Form transmission failure<h2>";
        exit();
    }

    $economyTotal = 0;
    $businessTotal = 0;
    $firstClassTotal = 0;

    if (($economyQuantity == "" || $economyQuantity == "0") && ($businessQuantity == "" || $businessQuantity == "0") && ($firstClassQuantity == "" || $firstClassQuantity == "0")) {
        echo "<br><br><br><input onclick='history.go(-1);' type='submit' class='btn' value='Back to ticket selection'>";
        echo "<br><h2><strong>ERROR:</strong> You have not selected any flight tickets<h2>";
        exit();
    }

    for ($x = 0; $x < $economyQuantity; $x++) {
        $economyTotal = $economyTotal + $economyPrice;
    }

    for ($x = 0; $x < $businessQuantity; $x++) {
        $businessTotal = $businessTotal + $businessPrice;
    }

    for ($x = 0; $x < $firstClassQuantity; $x++) {
        $firstClassTotal = $firstClassTotal + $firstClassPrice;
    }

    $fullTotal = $economyTotal + $businessTotal + $firstClassTotal;
}
//USE FOR LOOP, THAT LOOPS FOR THE CLASS QUANTITY AMOUNT AND ADDS THAT BOOKING TO THE DB EVERY TIME, DO THIS FOR EACH CLASS
?>

<br><br><br><br>
<div class = "container" style="background-color:white;">



 <form action="paymentConfirmation.php" method="post">

     <h2>Summary</h2>

     <?php  if ($economyQuantity > 0) {
       echo "<h5 style='color:darkgray;'>$economyQuantity X Economy Class Ticket | £$economyTotal</h5>";
     } ?>

     <?php  if ($businessQuantity > 0) {
       echo "<h5 style='color:darkgray;'>$businessQuantity X Business Class Ticket | £$businessTotal</h5>";
     } ?>

     <?php  if ($firstClassQuantity > 0) {
       echo "<h5 style='color:darkgray;'>$firstClassQuantity X First Class Ticket | £$firstClassTotal</h5>";
     }


    echo "<h5 style='color:darkgray;'> <strong>Full Total: £$fullTotal</strong>";
     ?> <br>

     <h2>Credit & Debit Cards </h2>
     <p style="color:gray"> Transaction fees may apply</p>

     <br>

     <div class="form-group">
         <label for="name">Cardholder Name:</label>
         <input type="text" name="card_name" id ="card_name" class="form-control" value="<?php echo $_SESSION["first_name"]. " ". $_SESSION["last_name"]?>"

     <div class="form-group">
         <label for="cardNumber"><br>Card Number:</label>
         <input type="number" name="card_number" id ="card_number" class="form-control" placeholder="XXXXXXXXXXXXXXXX">
     </div>

     <div class="form-group">
         <label for = "CVC">CVC</label>
         <input type="password" name="card_cvc" id = "card_cvc" class="form-control" placeholder="3 Digits" maxlength="3">

     </div> <br>



     <div class="form-group" style="text-align: center;">
       <input type="hidden" name="economy_quantity" value='<?php echo"$economyQuantity"?>'></input>
       <input type="hidden" name="business_quantity" value='<?php echo"$businessQuantity"?>'></input>
       <input type="hidden" name="firstclass_quantity" value='<?php echo"$firstClassQuantity"?>'></input>
       <input type="hidden" name="flight_id" value='<?php echo"$flightId"?>'></input>
       <input type="submit" class ="btn btn-primary" name="submitBtn" value="Pay Now">
       <input type="reset" class="btn btn-secondary ml-2" value="Reset">
     </div>
 </form><br><br>

</div>

<div class = "container" style="text-align: center; background-color:white;">

  <img src="assets/images/visa-mastercard-maestro.png" alt="Accepted Payment Methods" align="middle">

</div>
<br><br><br>
<?php include "footer.php";
?>
