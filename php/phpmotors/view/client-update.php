<?php
if(!$_SESSION['loggedin']){
    header('Location: /phpmotors');
   }

$title="Registration";
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php';?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php';?>

<h1 class="title">Update Account Information</h1>

<?php
if (isset($message)) {
 echo $message;
}
?>
<h2>Update Account Info</h2>
<form method="post" action="/phpmotors/accounts/index.php">
    <label for="clientFirstname" class="required" >First Name</label><br>
    <input name="clientFirstname" id="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} elseif(isset($clientInfo['clientFirstname'])) {echo "value='$clientInfo[clientFirstname]'";}?>  type="text" required><br>

    <label for="clientLastname" class="required">Last Name</label><br>
    <input name="clientLastname"  id="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";} elseif(isset($clientInfo['clientLastname'])) {echo "value='$clientInfo[clientLastname]'";}?> type="text" required><br>

    <label for="clientEmail" class="required">Email</label><br>
    <input name="clientEmail" id="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";} elseif(isset($clientInfo['clientEmail'])) {echo "value='$clientInfo[clientEmail]'";}?> type="email" required><br>
   
    <input type="submit" name="submit" id="updateInfobtn" value="Update Info" class="button"> 
     <!-- Add the action name - value pair  -->
     <input type="hidden" name="action" value="updateInfo">
     <input type="hidden" name="clientId" value="
     <?php if(isset($clientInfo['clientId'])){ echo $clientInfo['clientId'];} 
     elseif(isset($clientId)){ echo $clientId; } ?>">
</form>
<?php
if (isset($passMessage)) {
 echo $passMessage;
}
?>
<h2>Update Password</h2>
<form method="post" action="/phpmotors/accounts/index.php">
    <label for="clientPassword" class="required">Password</label><br>
    <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span><br>
    <span>*note your original password will be changed</span><br>
    <input name="clientPassword" id="clientPassword" type="password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>

    <input type="submit" name="submit" id="updatedPassword" value="Update Password" class="button"> 
    <!-- Add the action name - value pair  -->
    <input type="hidden" name="action" value="updatePassword">
    <input type="hidden" name="clientId" value="
    <?php if(isset($clientInfo['clientId'])){ echo $clientInfo['clientId'];} 
    elseif(isset($clientId)){ echo $clientId; } ?>">
</form>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
