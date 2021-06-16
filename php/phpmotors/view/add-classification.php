<?php
    if(!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] = 1){
        header('Location: /phpmotors');
    }
    $title="Add Car Classification";
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php';?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php';?>

<h1 class="title">Add Car Classification</h1>

<?php
if (isset($message)) {
    echo $message;
}
?>


<form method="post" action="/phpmotors/vehicles/index.php">
    <label for="classificationName" class="required">Classification Name</label><br>
    <input name="classificationName" id="classificationName" type="text" <?php if(isset($classificationName)){echo "value='$classificationName'";}  ?> required><br>

    <input type="submit" name="submit" id="addbtn" value="Add Classification" class="button"> 
     <!-- Add the action name - value pair  -->
     <input type="hidden" name="action" value="submitClass">

</form>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>

