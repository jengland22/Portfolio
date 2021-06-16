<?php
    $title="Registration";
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php';?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php';?>

<h1 class="title">Register</h1>

<?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
   }
?>

<form method="post" action="/phpmotors/accounts/index.php">
    <label for="clientFirstname" class="required" >First Name</label><br>
    <input name="clientFirstname" id="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}?>  type="text" required><br>

    <label for="clientLastname" class="required">Last Name</label><br>
    <input name="clientLastname"  id="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}?> type="text" required><br>

    <label for="clientEmail" class="required">Email</label><br>
    <input name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}?> type="email" required><br>

    <label for="clientPassword" class="required">Password</label><br>
    <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span><br>
    <input name="clientPassword" id="clientPassword" type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
   
    <input type="submit" name="submit" id="regbtn" value="Register" class="button"> 
     <!-- Add the action name - value pair  -->
     <input type="hidden" name="action" value="register">
</form>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
