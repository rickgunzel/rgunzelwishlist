<?php
require_once("includes/db.php");
 include ("includes/header.php");
$logonSuccess = false;


// verify user's credentials
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $logonSuccess = (WishDB::getInstance()->verify_wisher_credentials($_POST['user'], $_POST['userpassword']));
    if ($logonSuccess == true) {
        session_start();
        $_SESSION['user'] = $_POST['user'];
        header('Location: editWishList.php');
        exit;
    }
}
?>

     
       
        
        
        <input type="submit" name="myWishList" value="My Wishlist >>" onclick="javascript:showHideLogonForm()"/>
        <br/>
        Still don't have a wish list?! <a href="createNewWisher.php">Create now</a>
        <form name="logon" action="index.php" method="POST" style="visibility:<?php
              if ($logonSuccess)
                  echo "hidden";
              else
                  echo "visible";
              ?>">

            
            Username: <input type="text" name="user">
            Password  <input type="password" name="userpassword">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (!$logonSuccess)
                    echo "Invalid name and/or password";
            }
            ?>

            <input type="submit" value="Edit My Wish List">
        </form>
        
        <br/>
        <br/>
        <br/>
        
        <input type="submit" name="showWishList" value="Show Wish List of >>" onclick="javascript:showHideShowWishListForm()"/>
        
        <form name="wishList" action="wishlist.php" style="visibility:hidden">
            Show wish list of: <input type="text" name="user" value="" />
            <input type="submit" value="Go" name="submit" />
        </form>
        <script>
            function showHideLogonForm() {
                if (document.all.logon.style.visibility == "visible") {
                    document.all.logon.style.visibility = "hidden";
                    document.all.myWishList.value = "My Wishlist >>";
                }
                else {
                    document.all.logon.style.visibility = "visible";
                    document.all.myWishList.value = "<< My Wishlist";
                }
            }
            function showHideShowWishListForm() {
                if (document.all.wishList.style.visibility == "visible") {
                    document.all.wishList.style.visibility = "hidden";
                    document.all.showWishList.value = "Show Wish List of >>";
                }
                else {
                    document.all.wishList.style.visibility = "visible";
                    document.all.showWishList.value = "<< Show Wish List of";
                }
            }
        </script>
        
</div>
</div>

  