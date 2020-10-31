<?php
include "header.php";


$errors=array();

if(isset($_POST['submit'])) {
    $username=isset($_POST['username'])?$_POST['username']:'';
    $password=isset($_POST['password'])?$_POST['password']:'';
    $repassword=isset($_POST['repassword'])?$_POST['repassword']:'';
    $email=isset($_POST['email'])?$_POST['email']:'';
    $id=$_SESSION['userdata']['user_id'];
    $name=$_SESSION['userdata']['user_name'];

    if($password != $repassword) {
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
        $sql="UPDATE users SET `user_name`='".$username."', `password`='".$password."', `email`='".$email."' WHERE  `user_id`='".$id."' " ;

        if ($conn->query($sql) === true) {
            $sql1= "SELECT * FROM users where `user_id`='".$id."'";
            $res = $conn->query($sql1);
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    $_SESSION['userdata'] = array('user_name' => $row['user_name'],'user_id' => $row['user_id'], 'password'=> $row['password'], 'email'=>$row['email'] );
                    echo '<h2>Your data is updated'.' '.$_SESSION['userdata']['user_name'].'</h2>' ;
                    header('Location:update.php');
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
if (isset($_POST['dashboard'])) {
    header('Location:index.php');

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
    <div id="wrapmain1">
    <?php
    echo "<div id='updtdetails'>";
    echo '<h4>Your account details are given below'.' '.$_SESSION['userdata']['user_name'].':</h4>' ;

    echo 'USER ID: '.$_SESSION['userdata']['user_id'].'<br> ';
    echo 'USER NAME: '.$_SESSION['userdata']['user_name'].'<br> ';
    echo 'PASSWORD: '.$_SESSION['userdata']['password'].'<br> ';
    echo 'EMAIL: '.$_SESSION['userdata']['email'].'<br> ';
    echo '</div>';
    ?>
    <div id="main1">
    <h2>Update</h2>
        <form id="updateForm" action="updateuser.php" method="POST" enctype="multipart/form-data">
            <label for="username">Username:<input type="text" value="<?php echo $_SESSION['userdata']['user_name']; ?>" name="username"></label>
            <label for="password">Password:<input type="password" value="<?php echo $_SESSION['userdata']['password']; ?>" name="password"></label>
            <label for="repassword">Re-Password:<input type="password" value="<?php echo $_SESSION['userdata']['password']; ?>" name="repassword"></label>
            <label for="email">Email:<input type="text" value="<?php echo $_SESSION['userdata']['email']; ?>" name="email"></label>
            <p><input type="submit" name="submit" value="Update"></p>
        </form>
    </div>
    </div>
<?php include "footer.php"; ?>