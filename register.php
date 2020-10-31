<?php

include "config.php";
$errors=array();


if (isset($_POST['submit'])) {
    $username=isset($_POST['username'])?$_POST['username']:'';
    $password=isset($_POST['password'])?$_POST['password']:'';
    $repassword=isset($_POST['repassword'])?$_POST['repassword']:'';
    $email=isset($_POST['email'])?$_POST['email']:'';

    if ($password != $repassword) {
        $errors[] =array('input'=>'password', 'msg'=>'password does not match');
    }
    if ($username=='') {
        $errors[] =array('input'=>'password', 'msg'=>'Username is required');
    } else {
        if (!preg_match("/^[a-zA-Z-' ]*$/" ,$username)) {
            $errors[]=array('input'=>'form','msg'=>'Only letters and white space allowed in username') ;

        }
    }
    if ($password=='') {
        $errors[] =array('input'=>'password', 'msg'=>'Password is required');
    }
    if ($email=='') {
        $errors[] =array('input'=>'password', 'msg'=>'email is required');
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[]=array('input'=>'form','msg'=>'Invalid email format');
        }
    }


    if (sizeof($errors)==0) {


        $sql = "INSERT INTO users(`user_name`, `password`, `email`) VALUES('".$username."', '".$password."', '".$email."'  )" ;

        if ($conn->query($sql) === true) {
            echo "New record created successfully";
        } else {
            $errors[] = array('input'=>'form','msg'=>$conn->error);
        }
        $conn->close();
    }
}
if (isset($_POST['loginpage'])) {
    header('Location:login.php');

}


?>
<html>
<head>
    <title>
        Register
    </title>
    <link href="style.css" type="text/css" rel="stylesheet">
</head>
<body>
    <div id="errors">
        <?php if(sizeof($errors)>0) : ?>
            <ul>
            <?php foreach($errors as $error): ?>
                <li><?php echo $error['msg']; ?></li>
            <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <div id="main1">
        <h1>Register</h1>
        <form id="signupForm" action="register.php" method="POST" enctype="multipart/form-data">
            <label for="username">Username:<input type="text"  name="username"></label>
            <label for="password">Password:<input type="password"  name="password"></label>
            <label for="repassword">Re-Password:<input type="password"  name="repassword"></label>
            <label for="email">Email:<input type="text"  name="email"></label>
            <p><input type="submit" name="submit" value="Submit"><input type="submit" name="loginpage" value="Login"></p>
        </form>
    </div>
</body>
</html>