
<?php include 'header.php';

if (!($_SESSION['userdata']['user_name']) || !($_SESSION['userdata']['password'])) {
     header("Location:signin.php"); /* Redirect browser */
}


?>

<div id="main">
        <div id="contact-form">
            <form action="" method="">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control">
                <label for="email">Email:</label>
                <input type="text" name="email" class="form-control">
                <label for="message">Message:</label>
                <textarea name="message" cols="45" rows="6" class="form-control"></textarea>
                <p class="submit">
                    <input type="submit" name="submit" value="Submit">
                </p>
            </form>
        </div>

    </div>
<?php include 'footer.php';?>