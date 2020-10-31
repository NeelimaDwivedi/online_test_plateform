<?php include 'adminheader.php';
if (isset($_POST['manageuser'])) {
    header('Location:manageuser.php');
}
if (isset($_POST['addsubject'])) {
    header('Location:addsubject.php');
}
if (isset($_POST['managesubject'])) {
    header('Location:managesubject.php');
}

?>

<div id='adminwrap'>
<form id="adminAction" method="POST">
    <input type="submit" name="manageuser" value="MANAGE USER">
    <input type="submit" name="addsubject" value="ADD SUBJECT" >
    <input type="submit" name="managesubject" value="MANAGE SUBJECT" >
</form>
</div>
