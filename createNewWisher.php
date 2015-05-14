<!DOCTYPE html>
<?php
/** database connection credentials */
require_once("includes/db.php");
require_once("includes/header.php");

/** other variables */
$userNameIsUnique = true;
$passwordIsValid = true;
$userIsEmpty = false;
$passwordIsEmpty = false;
$password2IsEmpty = false;
/** Check that the page was requested from itself via the POST method. */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /** Check whether the user has filled in the wisher's name in the text field "user" */
    if ($_POST["user"] == "") {
        $userIsEmpty = true;
    }
    /** Create database connection */
    $wisherID = WishDB::getInstance()->get_wisher_id_by_name($_POST["user"]);
    if ($wisherID) {
        $userNameIsUnique = false;
    }


    if (!$userIsEmpty && $userNameIsUnique && !$passwordIsEmpty && !$password2IsEmpty && $passwordIsValid) {
        WishDB::getInstance()->create_wisher($_POST['user'], $_POST['password']);
        session_start();
$_SESSION['user'] = $_POST['user'];

        header('Location: editWishList.php' );
        exit;

    }
}
?>

<br/><br/><br/><br/><br/>
<h2>Welcome!</h2><br>
        <form action="createNewWisher.php" method="POST">
            Your name: <input type="text" name="user"/><br/>
            <?php
            if ($userIsEmpty) {
                echo ("Enter your name, please!");
                echo ("<br/>");
            }
            if (!$userNameIsUnique) {
                echo ("The person already exists. Please check the spelling and try again");
                echo ("<br/>");
            }
            ?> 

            Password: <input type="password" name="password"/><br/>
            <?php
            if ($passwordIsEmpty) {
                echo ("Enter the password, please!");
                echo ("<br/>");
            }
            ?>

            Please confirm your password: <input type="password" name="password2"/><br/>
            <input type="submit" value="Register"/>
            <?php
            if ($password2IsEmpty) {
                echo ("Confirm your password, please");
                echo ("<br/>");
            }
            if (!$password2IsEmpty && !$passwordIsValid) {
                echo ("The passwords do not match!");
                echo ("<br/>");
            }
            ?>

        </form>
</div></div>

