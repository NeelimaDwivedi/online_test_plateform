<?php include "adminheader.php";
echo '<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">';


if (isset($_GET['delete'])) {
    $id=$_GET['delete'];
    //echo $id;
    $mysql = "DELETE FROM users WHERE `user_id`=$id ";
    if ($conn->query($mysql) === true) {
        header('Location:manageuser.php');
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);

echo "<div id='managewrap'>";
if ($result->num_rows > 0) {
    echo "<div id='wrap'>";
    echo "<h2>Manage Users</h2>";
    echo "<table id='user'><tr><th>ID</th><th>NAME</th><th>PASSWORD</th><th>EMAIL</th><th>ROLE</th><th colspan='2'>ACTIONS</th></tr>" ;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";

        echo "<td>" . $row['user_id'] . "</td>";

        echo "<td>" . $row['user_name'] . "</td>";

        echo "<td>" . $row['password'] . "</td>";

        echo "<td>" . $row['email'] . "</td>";

        echo "<td>" . $row['role'] . "</td>";

        echo "<td><a href='edituser.php?edit= $row[user_id]'><i class='material-icons'>edit</i></a></td>" ;

        echo "<td><a href='manageuser.php?delete= $row[user_id]'><i class='material-icons'>delete</i></a></td>" ;

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