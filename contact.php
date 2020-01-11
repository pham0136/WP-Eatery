<?php

include "Connection.php";

$errorName = "";
$errorPhone = "";
$errorEmail = "";
$errorRef = "";
$success = "";

$name = "";
$phone = "";
$email = "";
$referrer = "";

if(isset($_POST['btnSubmit'])){
    $connect = new Connection();
    
    if(isset($_POST['customerName']) && !empty($_POST['customerName'])){
        $name = $_POST['customerName'];
    }else{
        $errorName = "Customer name can not be blank<br>";
    }

    if(isset($_POST['phoneNumber']) && !empty($_POST['phoneNumber'])){
        $phone = $_POST['phoneNumber'];

        if (!preg_match("/[2-9]\d{2}-\d{3}-\d{4}/", $phone)){
            $errorPhone = "Please re_enter as format (613-123-1234)";
        }
    }else{
        // $errorPhone = $error . "Phone number can not be blank<br>";
        $errorPhone =  "Phone number can not be blank<br>";
    }

    if(isset($_POST['emailAddress']) && !empty($_POST['emailAddress'])){
        $email = $_POST['emailAddress'];
        if (preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/", $email)){
            // query the email address in the database
            // find in the mailing_list table all the users who have the email $email
            // select query where email=$email
            $query = "SELECT * FROM `mailinglist`  where emailAddress = '$email'";
            $result = $connect->execute($query);

            if($result->num_rows > 0){ // dont change
                $errorEmail = "This email already exists";
            }
        }else{
            $errorEmail="Please re_enter valid email address";
        }
    }else{
        $errorEmail = "Email address can not be blank<br>";
    }

    if(isset($_POST['referral']) && !empty($_POST['referral'])){
        $referrer = $_POST['referral'];
    }else{
        $errorRef = "The referral can not be blank<br>";
    }

    // $name = $_POST['customerName'];
    // $phone = $_POST['phoneNumber'];
    // $email = $_POST['emailAddress'];
    // $referrer = $_POST['referral'];

    if(empty($errorName) && empty($errorPhone) && empty($errorEmail) && empty($errorRef)){

        $query = "INSERT INTO mailinglist(customerName, phoneNumber, emailAddress, referrer) VALUES('$name', '$phone', '$email', '$referrer')";
        // mysqli_query($, $query);
        $connect->execute($query);

        $success = "Data was inserted successfully!";
        $name = "";
        $phone = "";
        $email = "";
        $referrer = "";

    }

    // $query = "INSERT INTO mailinglist(customerName, phoneNumber, emailAddress, referrer) VALUES('$name', '$phone', '$email', '$referrer')";

    // mysqli_query($link, $query);
    
    // echo $query;
}

include "header.php";
?>
 <div id="content" class="clearfix">
                <aside>
                        <h2>Mailing Address</h2>
                        <h3>1385 Woodroffe Ave<br>
                            Ottawa, ON K4C1A4</h3>
                        <h2>Phone Number</h2>
                        <h3>(613)727-4723</h3>
                        <h2>Fax Number</h2>
                        <h3>(613)555-1212</h3>
                        <h2>Email Address</h2>
                        <h3>info@wpeatery.com</h3>
                </aside>
                <div class="main">
                    <h1>Sign up for our newsletter</h1>
                    <p>Please fill out the following form to be kept up to date with news, specials, and promotions from the WP eatery!</p>
                    <span style="color: yellow">
                    <?php
                        echo $success;
                    ?>
                    </span>
                    <form name="frmNewsletter" id="frmNewsletter" method="post" action="">
                        <table>
                            <tr>
                                <td>Name:</td>
                                <td><input type="text" name="customerName" id="customerName" size='40' value="<?php echo $name; ?>"></td>
                                <td style="color: red">
                                <?php
                                    echo $errorName;
                                ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Phone Number:</td>
                                <td><input type="text" name="phoneNumber" id="phoneNumber" size='40' value="<?php echo $phone; ?>"></td>
                                <td style="color: red">
                                <?php
                                    echo $errorPhone;
                                ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Email Address:</td>
                                <td><input type="text" name="emailAddress" id="emailAddress" size='40' value="<?php echo $email; ?>">
                                <td style="color: red">
                                <?php
                                    echo $errorEmail;
                                ?>
                                </td>
                            </tr>
                            <tr>
                                <td>How did you hear<br> about us?</td>
                                <td>Newspaper<input type="radio" name="referral" id="referralNewspaper" value="newspaper" <?php if($referrer == "newspaper"){
                                        echo "checked";
                                    } ?>>
                                    Radio<input type="radio" name='referral' id='referralRadio' value='radio' <?php if ($referrer=="radio") 
                                        echo "checked" ;
                                    ?>>
                                    TV<input type='radio' name='referral' id='referralTV' value='TV' <?php if ($referrer=="TV") 
                                        echo "checked" ;
                                    ?>>
                                    Other<input type='radio' name='referral' id='referralOther' value='other' <?php if ($referrer=="other") 
                                        echo "checked" ;
                                    ?>>
                                </td>
                                <td style="color: red">
                                <?php
                                    echo $errorRef;
                                ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='2'><input type='submit' name='btnSubmit' id='btnSubmit' value='Sign up!'>&nbsp;&nbsp;<input type='reset' name="btnReset" id="btnReset" value="Reset Form"></td>
                            </tr>
                        </table>
                    </form>
                </div><!-- End Main -->
            </div><!-- End Content -->
    
    <?php
        include "footer.php";
    ?>
