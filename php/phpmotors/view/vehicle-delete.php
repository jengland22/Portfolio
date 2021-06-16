<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
   }
?>
<title><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";
    } ?> | PHP Motors</title>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php';?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php';?>

<h1><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";
    } ?> | PHP Motors</h1>

<?php
if (isset($message)) {
 echo $message;
}
?>

<h2>*Note all Fields are Required</h2>



<form method="post" action="/phpmotors/vehicles/">
    <fieldset>
        <label for="invMake">Vehicle Make</label>
        <input type="text" readonly name="invMake" id="invMake" <?php
        if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>

        <label for="invModel">Vehicle Model</label>
        <input type="text" readonly name="invModel" id="invModel" <?php
        if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>

        <label for="invDescription">Vehicle Description</label>
        <textarea name="invDescription" readonly id="invDescription"><?php
        if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }
        ?></textarea>

        <input type="submit" class="regbtn" name="submit" value="Delete Vehicle">

        <input type="hidden" name="action" value="deleteVehicle">
        <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){
        echo $invInfo['invId'];} ?>">

    </fieldset>
</form>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>

