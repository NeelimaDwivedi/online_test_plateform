<?php
include "adminheader.php";
$errors=array();
if (isset($_GET['edit'])) {
    $uid=$_GET['edit'];


    $sql = "SELECT * FROM users where `user_id`=$uid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $_SESSION['useredit'] = array('user_name' => $row['user_name'],'user_id' => $row['user_id'], 'password'=> $row['password'], 'email'=>$row['email'], 'role'=>$row['role'] );

        }
    } else {
        echo "0 results";
    }
    $conn->close();

}

if (isset($_POST['submit'])) {
    $username=isset($_POST['username'])?$_POST['username']:'';
    $password=isset($_POST['password'])?$_POST['password']:'';
    $repassword=isset($_POST['repassword'])?$_POST['repassword']:'';
    $email=isset($_POST['email'])?$_POST['email']:'';
    $role=isset($_POST['role'])?$_POST['role']:'';
    $id=$_SESSION['useredit']['user_id'];


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
        $sql="UPDATE users SET `user_name`='".$username."', `password`='".$password."', `email`='".$email."', `role`='".$role."' WHERE  `user_id`='".$id."' " ;
        if ($conn->query($sql) === true) {
            $sql1= "SELECT * FROM users where `user_id`='".$id."'";
            $res = $conn->query($sql1);
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    $_SESSION['useredit'] = array('user_name' => $row['user_name'],'user_id' => $row['user_id'], 'password'=> $row['password'], 'email'=>$row['email'], 'role'=>$row['role'] );
                    echo '<h2>Your data for the user'.' '.$_SESSION['useredit']['user_name'].' is updated</h2>' ;
                }
            } else {
                $errors[]=array('input'=>'form','msg'=>'Invalid Updation');
            }
        } else {
            echo "Error updating record: " . $conn->error;
        }
        $conn->close();
    }

}


?>
<html>
<head>
    <title>
        Update
    </title>
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
    <h2>Update</h2>
        <form id="updateForm" action="edituser.php" method="POST" enctype="multipart/form-data">
            <label for="username">Username:<input type="text" value="<?php echo $_SESSION['useredit']['user_name']; ?>" name="username"></label>
            <label for="password">Password:<input type="password" value="<?php echo $_SESSION['useredit']['password']; ?>" name="password"></label>
            <label for="repassword">Re-Password:<input type="password" value="<?php echo $_SESSION['useredit']['password']; ?>" name="repassword"></label>
            <label for="email">Email:<input type="text" value="<?php echo $_SESSION['useredit']['email']; ?>"  name="email"></label>
            <label for="role">Role:<input type="text" value="<?php echo $_SESSION['useredit']['role']; ?>"  name="role"></label>
            <p><input type="submit" name="submit" value="Update"><a href='manageuser.php'>Click here to see updated records</a></p>
        </form>
    </div>

