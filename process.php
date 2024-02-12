<?php
require_once('./config.php');
session_start();

//This is for editing existing student
$update = false;
$Sid = 0;
$Sname = "";
$age = "";
$email = "";


if (isset($_POST['save'])) {

    print_r($_POST);

    $Sname = $_POST['Sname'];
    $age = $_POST['age'];
    $email = $_POST['email'];

    $sql = "INSERT INTO student_details (Sname, age, email) VALUES ('$Sname', $age, '$email')";

    $database->query($sql) or die($database->error);
    echo "Record has been saved!";
    echo "Now you are in the process.php file $_POST[save]";

    header("Location: index.php");
}

if (isset($_GET['delete'])) {

    $id = $_GET['delete']; //7

    $sql = "DELETE FROM student_details WHERE Sid = $id"; //7

    $database->query($sql) or die($database->error);

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    echo "<h1>Now you are in the process.php file /$_GET[delete]/<-deleted</h1>";

    header("Location: index.php");
}

if (isset($_GET['edit'])) {
    $u_id = $_GET['edit'];
    $update = true;

    // if session error occurs, use ==>  $_SESSION['error_up'] ="";

    $result = $database->query("SELECT * FROM student_details WHERE Sid = $u_id") or die($mysqli->error);
    if (count(array($result)) == 1) {
        $row = $result->fetch_array() or die($database->error);
        $Sid = $row['Sid'];
        $Sname = $row['Sname'];
        $age = $row['age'];
        $email = $row['email'];

    }
}

if (isset($_POST['update'])) {

    $Sid = $_POST['Sid'];
    $Sname = $_POST['Sname'];
    $age = $_POST['age'];
    $email = $_POST['email'];

    $sql = "UPDATE student_details SET Sname='$Sname', age=$age, email='$email' WHERE Sid = $Sid";
    
    $database->query($sql) or die($database->error);

 
    $_SESSION['message'] = "Record has been Updated!";
    $_SESSION['msg_type'] = "warning";
    header("Location: index.php");
}


?>
