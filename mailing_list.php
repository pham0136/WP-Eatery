<?php
include "Connection.php";

$connect = new Connection();

$errorId = "";
$errorName = "";
$success = "";

if(isset($_POST["btnDelete"])){
    // todo: error checking (isset and empty)
    if (isset($_POST["id"]) && !empty($_POST["id"])){
        $id = $_POST["id"];
    }
    else {
        $errorId = "Id should not empty!";
    }

    if (isset($_POST["name"]) && !empty($_POST["name"])){
        $name = $_POST["name"];
    }
    else {
        $errorName = "Customer name should not empty!";
    }

    // if no error do the query
    if (empty($errorId) && empty($errorName)){

        
        $query= "DELETE FROM mailinglist where _id='$id' and customerName='$name'";
        $connect->execute($query);

        $success = "Data is deleted successfully!";
    }
}

include "header.php";
?>

<div id="content" class="clearfix">

<table>
<tr>
    <th>ID</th>
    <th>Customer name</th>
    <th>Phone number</th>
    <th>Email address</th>
</tr>

<?php
    $query = "SELECT _id, customerName, phoneNumber, emailAddress from mailinglist";
    $connect->execute($query);

    $result = $connect->execute($query);

    $row = mysqli_fetch_assoc($result);

    while(!empty($row)){
        echo "<tr><td>$row[_id]</td><td>$row[customerName]</td><td>$row[phoneNumber]</td><td>$row[emailAddress]</td></tr>";

        $row = mysqli_fetch_assoc($result);
    }
?>

</table>
<hr>
<form action="" method = "Post">
<table>
    <tr>
        <td>ID</td>
        <td><input type="number" name="id"></td>
        <td style="color: red">
        <?php
            echo $errorId;
        ?>
        </td>
    </tr>
    <tr>
        <td>Customer name</td>
        <td><input type="text" name ="name"></td>
        <td style="color: red">
        <?php
            echo $errorName;
        ?>
        </td>
    </tr>
    <tr>
        <td>
            <button name = "btnDelete" value = "Delete">Delete</button>
        </td>
        <td style="color: yellow">
            <?php
            echo $success;
            ?>
        </td>
    </tr>


</table>
</form>

</div>



<?php
include "footer.php";
?>
