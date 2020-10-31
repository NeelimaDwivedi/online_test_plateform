<?php
error_reporting(0);
session_start();
$errors=array();
include "config.php";
$id=$_SESSION['userdata']['user_id'];
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location:login.php');
}
if (isset($_POST['update'])) {
    header('Location:updateuser.php');
}
if (isset($_POST['delete'])) {
    $sql = "DELETE FROM users WHERE `user_id`='".$id."'";

    if ($conn->query($sql) === true) {
        header('Location:login.php');
        echo "Record deleted successfully";
    } else {
        $errors[]=array('input'=>'form','msg'=>$conn->error);
    }
    $conn->close();
}

?>



<!DOCTYPE html>
<html>
<head>
    <title>
        Online Examination Plateform
    </title>
    <link href="style.css?x=1" type="text/css" rel="stylesheet">
</head>
<body>
    <div id="header">
        <h1 id="logo">Logo</h1>
        <?php
        echo '<h2>Welcome'.' '.$_SESSION['userdata']['user_name'].'</h2>';
        ?>

        <nav>
            <ul id="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <form  method="POST">
                    <li><input type="submit" name="update" value="   Update"></li>
                    <li><input type="submit" name="logout" value="Logout"></li>
                    <li><input type="submit" name="delete" value="Delete Account" ></li>
                </form>

            </ul>
        </nav>
    </div>



