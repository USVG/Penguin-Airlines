<?php
include "connection.php";
include "ifSessionHeader.php";
$email_err = $password_err = $first_name_err = $last_name_err = $post_code_err = $address_err = $country_err = $phone_number_err = "";


if($_SESSION["email"] == ""){
    header("Location: loginForm.php");
}else{



if(isset($_POST['update'])){

    $patternPhoneNumber = "/^(\+44\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/";

    $match = preg_match($patternPhoneNumber,trim($_POST["phone_number"]));





    if(filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)){
        $email = trim($_POST['email']);
    }else{
        $email_err = "Please enter a VALID Email";
    }

        if ($match != false) {
            $phone_number = trim($_POST["phone_number"]);
        } else {
            $phone_number_err = "Incorrect Format, Use 07222 555555 or +44 7222 555 555 Format";
        }


    if (preg_match('/[0-9]+/', trim($_POST["first_name"]))) {
        $first_name_err = "Name can't contain numbers!";
    }else{
        $first_name = trim($_POST["first_name"]);
    }




    if (preg_match('/[0-9]+/', trim($_POST["last_name"]))) {
        $last_name_err = "Name can't contain numbers!";
    }else{
        $last_name = trim($_POST["last_name"]);
    }

    if (preg_match('/[0-9]+/', trim($_POST["country"]))) {
        $last_name_err = "Country can't contain numbers!";
    }else{
        $country = trim($_POST["country"]);
    }








   $email = $_POST['email'];
   // $first_name = $_POST['first_name'];
    //$last_name = $_POST['last_name'];
    //$country = $_POST['country'];
    $address = $_POST['address'];
    $post_code = $_POST['post_code'];
   // $phone_number = $_POST['phone_number'];
    $id = $_SESSION['id'];



    if(empty($phone_number_err) && empty($last_name_err) && empty($first_name_err) && empty($email_err) && empty($country_err)){

        $pdoQuery = "UPDATE users SET email = :email, first_name = :first_name, last_name = :last_name, 
                 country = :country, address = :address, post_code = :post_code, phone_number = :phone_number WHERE id= :id";
        $pdoQuery_run = $conn->prepare($pdoQuery);
        $pdoQuery_execute = $pdoQuery_run->execute(array(":email"=>$email, ":first_name"=>$first_name, ":last_name"=>$last_name,
            ":country"=>$country, ":address"=>$address, ":post_code"=>$post_code, ":phone_number"=>$phone_number, ":id"=>$id));

        if($pdoQuery_execute){
            echo '<script>alert("Profile Updated!") </script>';

            header("Location: logout.php");

        }else{
            echo '<script>alert("Profile NOT Updated!") </script>';
        }
    }
    }




}
?>
<html>

<style>

    input{
        width: 50%;
        height: 30px;
    }
    text{
        width: 50%;
        height: 30px;

    }
    label{
        margin-right: 30px;

    }
    input{

        width: 60%;
    }
    .text-body{
        width: 50%;
    }
    table{
        background-color:white;
        border: 5px;
        border-color: black;
    }
    h2{
        font-size: 22px;
    }

</style>
<body>

<h1 align="center"> <b> Update your account details </b></h1>
<h2 align="center">After you click update you will be logged out and going to need login again</h2>
<form action ="" method="POST">
    <table  width="50%" border="1" cellpadding="5" cellspacing="5" align="center">
        <tr>
            <td><br><br>
                <center>
                    <div class="text-body"
                    <br>
                    <label> Update Email</label> <br>
                    <input type="text" name="email" value="<?php echo  $_SESSION["email"]?>" class="form-control
           <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $email_err; ?></span>  <br>
                    <label> Update First Name</label>

                    <input type="text" name="first_name" value="<?php echo  $_SESSION["first_name"]?>" class="form-control
            <?php echo (!empty($first_name_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $first_name_err; ?></span>  <br>
                    <br>
                    <label> Update Last Name</label>
                    <input type="text" name="last_name" value="<?php echo  $_SESSION["last_name"]?>" class="form-control
            <?php echo (!empty($last_name_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $last_name_err; ?></span> <br>
                    <br>
                    <label> Update Country</label>
                    <input type="text" name="country" value="<?php echo  $_SESSION["country"]?>" class="form-control
            <?php echo (!empty($country_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $country_err; ?></span> <br>
                    <br>
                    <label> Update Address</label>
                    <input type="text" name="address" value="<?php echo  $_SESSION["address"]?>" class="form-control ">
                    <br>
                    <label> Update Post Code</label>
                    <input type="text" name="post_code" value="<?php echo  $_SESSION["post_code"]?>" class="form-control ">
                    <br>
                    <label> Update Phone Number</label>
                    <input type="text" name="phone_number" value="<?php echo  $_SESSION["phone_number"]?>" class="form-control
            <?php echo (!empty($phone_number_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $phone_number_err; ?></span>




                    <br>
                    <button class="btn btn-primary" type="submit" name = "update"> Update  </button>
                    </div>
                </center>
            </td>
        </tr>
    </table>
</form>
</body>
<?php
include ("footer.php");
?>
</html>
