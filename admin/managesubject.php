<?php include "adminheader.php";
echo '<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">';


if (isset($_GET['delete'])) {
    $id=$_GET['delete'];
    //echo $id;
    $mysql = "DELETE FROM subjects WHERE `subjectid`=$id ";
    if ($conn->query($mysql) === true) {
        header('Location:managesubject.php');
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $mysql1 = "DELETE FROM questions WHERE `subjectid`=$id ";
    if ($conn->query($mysql1) === true) {
        header('Location:managesubject.php');
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    //$conn->close();
}

$sql = "SELECT * FROM subjects";
$result = $conn->query($sql);

echo "<div id='managewrap'>";
if ($result->num_rows > 0) {
    echo "<div id='wrap'>";
    echo "<h3>Manage Users</h3>";
    echo "<table id='user'><tr><th>Subject Id</th><th>Subject Name</th><th colspan='2'>ACTIONS</th></tr>" ;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";

        echo "<td>" . $row['subjectid'] . "</td>";

        echo "<td>" . $row['subjectname'] . "</td>";


        echo "<td><a href='addquestion.php?add= $row[subjectid]'>Add Questions</a></td>" ;

        echo "<td><a href='managesubject.php?delete= $row[subjectid]'><i class='material-icons'>delete</i></a></td>" ;

        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
    echo '<p><a href="admindashboard.php">click here to go back</a></p>';
    echo "</div>";

} else {
    echo "0 results";
}
$conn->close();
?>