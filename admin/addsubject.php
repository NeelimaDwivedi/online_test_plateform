<?php

include "adminheader.php";
$errors=array();


if (isset($_POST['submit'])) {
    $sid=isset($_POST['sid'])?$_POST['sid']:'';
    $sname=isset($_POST['sname'])?$_POST['sname']:'';

    if ($sname=='') {
        $errors[] =array('input'=>'name', 'msg'=>' Subject name is required');
    }

    if ($sid=='') {
        $errors[] =array('input'=>'sid', 'msg'=>'Subject Id is required');
    }


    if (sizeof($errors)==0) {


        $sql = "INSERT INTO subjects(`subjectid`, `subjectname`) VALUES('".$sid."', '".$sname."' )" ;

        if ($conn->query($sql) === true) {
            echo "New Subject added successfully";
        } else {
            $errors[] = array('input'=>'form','msg'=>$conn->error);
        }
        $conn->close();
    }
}



?>
<html>
<head>
    <title>
        Add Subject
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
        <h1>Add Subject</h1>
        <form id="signupForm" action="addsubject.php" method="POST" enctype="multipart/form-data">
            <label for="Subject Id">Username:<input type="text"  name="sid"></label>
            <label for="Subject Name">Password:<input type="text"  name="sname"></label>
            <p><input type="submit" name="submit" value="Add Subject"><a href="admindashboard.php">click here to go back</a></p>
        </form>
    </div>
</body>
</html>