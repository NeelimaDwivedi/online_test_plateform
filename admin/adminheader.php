<?php
session_start();
$errors=array();
include "../config.php";

$id=$_SESSION['userdata']['user_id'];
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location:../login.php');
}

?>

<html>
<head>
    <title>
        Admin Panel
    </title>
    <link href="../style.css" type="text/css" rel="stylesheet">
</head>
<body>
    <div id="header">
        <h1 id="logo">Logo</h1>
        <?php
        echo '<h2>Welcome'.' '.$_SESSION['userdata']['user_name'].'</h2>';
        ?>

        <nav>
            <ul id="menu">
                <form  method="POST">
                    <li><input type="submit" name="logout" value="   Logout"></li>
                </form>

            </ul>
        </nav>
    </div>
