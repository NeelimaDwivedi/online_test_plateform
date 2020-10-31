<?php

session_start();
include "config.php";
$errors=array();


if(isset($_POST['submit'])) {
    $username=isset($_POST['username'])?$_POST['username']:'';
    $password=isset($_POST['password'])?$_POST['password']:'';


    if(sizeof($errors)==0) {


        $sql = 'SELECT * FROM users where
        `user_name`="'.$username.'" AND `password`="'.$password.'"' ;
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {

            // output data of each row
            while ($row = $result->fetch_assoc()) {
                if ($row['role']== 'admin') {

                    $_SESSION['userdata'] = array('user_name' => $row['user_name'],'user_id' => $row['user_id'], 'password'=> $row['password'], 'email'=>$row['email'], 'role'=>$row['role'] );
                    header('Location:admin\admindashboard.php');
                } else {
                    $_SESSION['userdata'] = array('user_name' => $row['user_name'],'user_id' => $row['user_id'], 'password'=> $row['password'], 'email'=>$row['email'] ) ;
                    header('Location:index.php');
                }
            }
        } else {
            $errors[]=array('input'=>'form','msg'=>'Invalid Login');
        }

        $conn->close();
    }
}
if (isset($_POST['registerpage'])) {
    header('Location:register.php');
}
?>


<html>
<head>
    <title>
        Login
    </title>
    <link type="text/css" rel="stylesheet" href="style.css?t=1">
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
    <di id="main1">
        <h1>Login</h1>
        <form id="signinForm" action="login.php" method="POST" enctype="multipart/form-data">
            <label for="username">Username:<input type="text"  name="username"></label>
            <label for="password">Password:<input type="password"  name="password"></label>
            <p><input type="submit" name="submit" value="Login"><input type="submit" name="registerpage" value="Register"></p>
        </form>
    </div>
</body>
</html>