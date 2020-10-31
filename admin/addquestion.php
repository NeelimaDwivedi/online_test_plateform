<?php
include "adminheader.php";
$errors=array();
if (isset($_GET['add'])) {
    $uid=$_GET['add'];


    $sql = "SELECT * FROM subjects where `subjectid`=$uid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {
            $_SESSION['subjectedit'] = array('subjectname' => $row['subjectname'],'subjectid' => $row['subjectid']) ;

        }
    } else {
        echo "0 results";
    }
    $conn->close();

}

if (isset($_POST['submit'])) {
    $sid=$_SESSION['subjectedit']['subjectid'];
    $ques=isset($_POST['ques'])?$_POST['ques']:'';
    $opt1=isset($_POST['opt1'])?$_POST['opt1']:'';
    $opt2=isset($_POST['opt2'])?$_POST['opt2']:'';
    $opt3=isset($_POST['opt3'])?$_POST['opt3']:'';
    $opt4=isset($_POST['opt4'])?$_POST['opt4']:'';
    $ans=isset($_POST['ans'])?$_POST['ans']:'';

    if ($ques=='') {
        $errors[] =array('input'=>'ques', 'msg'=>'Question is required');
    }
    if ($opt1=='') {
        $errors[] =array('input'=>'option', 'msg'=>' All options are required');
    }
    if ($ans=='') {
        $errors[] =array('input'=>'ans', 'msg'=>'Answer is required');
    }



    if (sizeof($errors)==0) {
        $sql = "INSERT INTO questions(`subjectid`, `ques`, `option1`, `option2`, `option3`, `option4`,`ans`) VALUES('".$sid."', '".$ques."', '".$opt1."', '".$opt2."', '".$opt3."', '".$opt4."', '".$ans."'  )" ;

        if ($conn->query($sql) === true) {
            echo "New question added successfully";
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
        Add Question
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
    <h2>Add Question</h2>
        <form id="updateForm" action="addquestion.php" method="POST" enctype="multipart/form-data">
            <label for="sid">Subject Id:<input type="text" value="<?php echo $_SESSION['subjectedit']['subjectid']; ?>" name="sid" disabled></label>
            <label for="ques">Question:<input type="text"  name="ques"></label>
            <label for="opt1">Option a:<input type="text"  name="opt1"></label>
            <label for="opt2">Option b:<input type="text"  name="opt2"></label>
            <label for="opt3">Option c:<input type="text"  name="opt3"></label>
            <label for="opt4">Option d:<input type="text"  name="opt4"></label>
            <label for="ans">Answer:<input type="text"  name="ans"></label>
            <p><input type="submit" name="submit" value="Add Question"><a href='managesubject.php'>Click here to go back</a></p>
        </form>
    </div>

