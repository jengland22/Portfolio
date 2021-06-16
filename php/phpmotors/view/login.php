<?php
    $title="Login";
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php';?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php';?>

<h1 class="title">PHP Motors Login</h1>
<?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
   }
?>
<form method="post" action="/phpmotors/accounts/">
    <label for="clientEmail" class="required">Email</label><br>
    <input type="email" id="clientEmail" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required><br>
    <label for="password" class="required">Password</label><br>
    <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span><br>
    <input type="password"  id="clientPassword" name="clientPassword" required><br>

    <input type="submit" name="submit" id="logbtn" value="Login" class="button"><br>
     <!-- Add the action name - value pair  -->
    <input type="hidden" name="action" value="Login">

    <a class="member" title="register page" href="http://localhost/phpmotors/accounts/index.php?action=registration">Not a member yet?</a>
</form>



<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
