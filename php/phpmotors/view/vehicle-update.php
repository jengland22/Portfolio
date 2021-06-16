<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
   }
    // build dynamiic drop-down select list
    // $classificationList = '<label for="classificationId"></label><br>';
    $classificationList = '<select id="classificationId" name="classificationId">';
    $classificationList .= '<option selected disabled>Choose Car Classification</option>';
    foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if(isset($classificationId)){
        if($classification['classificationId'] === $classificationId){
            $classificationList .= ' selected ';
        }
    }
    elseif(isset($invInfo['classificationId'])){
        if($classification['classificationId'] === $invInfo['classificationId']){
        $classificationList .= ' selected ';
    }
}
    $classificationList .= ">$classification[classificationName]</option>";
    }
    $classificationList .= '</select>';
?>
<title><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
        echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
        elseif(isset($invMake) && isset($invModel)) { 
		echo "Modify $invMake $invModel"; }?> | PHP Motors</title>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php';?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php';?>

<h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
            echo "Modify $invInfo[invMake] $invInfo[invModel]";} 
            elseif(isset($invMake) && isset($invModel)) { 
            echo "Modify$invMake $invModel"; 
            }?></h1>

<?php
if (isset($message)) {
 echo $message;
}
?>

<h2>*Note all Fields are Required</h2>



<form method="post" action="/phpmotors/vehicles/index.php">

    <?php echo $classificationList; ?><br>

    <label for="invMake" class="required">Make</label><br>
    <input name="invMake" id="invMake" type="text" <?php if(isset($invMake)){echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }  ?> required><br>

    <label for="invModel" class="required">Model</label><br>
    <input name="invModel" id="invModel" type="text" <?php if(isset($invModel)){echo "value='$invModel'";} elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?> required><br>

    <label for="invDescription" class="required">Description</label><br>
    <textarea name="invDescription" id="invDescription" required>
    <?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea><br>

    <label for="invimage" class="required">Image Path</label><br>
    <input name="invImage" id="invImage" type="text" <?php if(isset($invImage)){echo "value='$invImage'";} elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; }?>><br>

    <label for="invThumbnail" class="required">Thumbnail Path</label><br>
    <input name="invThumbnail" id="invThumbnail" type="text" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";} elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; }?> required value="phpmotors/images/no-image.png"><br>

    <label for="invPrice" class="required">Price</label><br>
    <input name="invPrice" id="invPrice" type="number" <?php if(isset($invPrice)){echo "value='$invPrice'";} elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }?> required><br>

    <label for="invStock" class="required"># In Stock</label><br>
    <input name="invStock" id="invStock" type="text"<?php if(isset($invStock)){echo "value='$invStock'";} elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; }?> required><br>

    <label for="invColor" class="required">Color</label><br>
    <input name="invColor" id="invColor" type="text" <?php if(isset($invColor)){echo "value='$invColor'";} elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }?> required><br>

    <input type="submit" name="submit" id="updatebtn" value="Update Vehicle" class="button"> 
    <!-- Add the action name - value pair  -->
    <input type="hidden" name="action" value="updateVehicle">
    <input type="hidden" name="invId" value="
    <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
    elseif(isset($invId)){ echo $invId; } ?>
    ">

</form>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>