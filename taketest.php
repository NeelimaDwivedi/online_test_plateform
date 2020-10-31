<?php include "header.php";
$flag1=0;
$flag2=0;
$str='';
$res='your result will display here';

if (isset($_GET['sid'])) {
    if (!isset($_SESSION['userdata'])) {
        header('Location:login.php');
    }
    $sid=$_GET['sid'];


    $sql = "SELECT * FROM questions where `subjectid`= $sid" ;
    $result = $conn->query($sql);
    $number_of_results=mysqli_num_rows($result);
    echo '<div id="main1">';
    echo '<form action="" method="post">';
    echo '<h3>MCQ type questions:</h3>';
    echo '<p>(Your result will display at the bottom after submitting the test.)</p>' ;
    echo '<table id="user">';


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                $qid=$row['qid'];
                echo '<tr><td colspan="4">'.$row['ques'].'</td></tr>';
                echo '<tr>';
                echo '<tr><td><input type="radio" id="opt1'.$qid.'" name="opt'.$qid.'" value="'.$row['option1'].'"><label for="opt1'.$qid.'">a)'.$row['option1'].'</label></td>' ;
                echo '<td><input type="radio" id="opt2'.$qid.'" name="opt'.$qid.'" value="'.$row['option2'].'"><label for="opt2'.$qid.'">b)'.$row['option2'].'</label></td></tr>' ;
                echo '<tr><td><input type="radio" id="opt3'.$qid.'" name="opt'.$qid.'" value="'.$row['option3'].'"><label for="opt3'.$qid.'">c)'.$row['option3'].'</label></td>' ;
                echo '<td><input type="radio" id="opt4'.$qid.'" name="opt'.$qid.'" value="'.$row['option4'].'"><label for="opt4'.$qid.'">d)'.$row['option4'].'</label></td></tr>' ;
                echo '</tr>';
                echo '</tr>';



                $ans=$row['ans'];

            if (isset($_POST['submit'])) {
                $opt=$_POST['opt'.$qid];
                if ($ans==$opt) {
                    $flag1++;
                    if ($flag1>8) {
                        $str= 'you passed the test, scored above 70%';
                    }
                } else {
                    if ($ans!=$opt) {
                        $flag2++;
                        if ($flag2>4) {
                            $str= 'you Failed!';

                        }
                    }
                }
                $res=$str;
            }



        }//end while


    } else {
            echo "0 results";
    }//end main if

//display result
    echo '</table><br>';

    echo "<tr><td><a href='#'><input type='submit' class='open-button' name='submit' value='Submit Test'></a></td></tr>" ;
    echo '<div class="notification attention ">';
    echo '<a href="#" class="close"><img src="images/cross_grey_small.png" title="Close this notification" alt="x" /></a>';
        echo '<div>';
            echo $_SESSION['userdata']['user_name'].' '.$res;
        echo '</div>';
    echo '</div>';
    echo '</form>';
    echo '</div>';


}
?>

