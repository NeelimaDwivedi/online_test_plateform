<?php include "header.php"; ?>
<html>
<head>
    <title>
        Home
    </title>
    <link href="style.css?q=2" type="text/css" rel="stylesheet">
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
        <?php
        $sql = "SELECT * FROM subjects";
        $result = $conn->query($sql);
        echo "<div id='indexwrap'>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='useraction'>".$row['subjectname']." "."<a href='taketest.php?sid=$row[subjectid]'>Take Test</a></div>" ;
            }
        }
        echo "</div>";
        ?>

<?php include "footer.php"; ?>