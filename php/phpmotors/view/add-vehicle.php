<?php
    if(!isset($_SESSION['loggedin']) || !$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] == 1){
        header('Location: /phpmotors');
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
    $classificationList .= ">$classification[classificationName]</option>";
    }
    $classificationList .= '</select>';
    $title="Add Car Classification";
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php';?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php';?>

<h1 class="title">Add Vehicle</h1>

<?php
if (isset($message)) {
 echo $message;
}
?>

<h2>*Note all Fields are Required</h2>



<form method="post" action="/phpmotors/vehicles/index.php">

    <?php echo $classificationList; ?><br>

    <label for="invMake" class="required">Make</label><br>
    <input name="invMake" id="invMake" type="text" <?php if(isset($invMake)){echo "value='$invMake'";}  ?> required><br>

    <label for="invModel" class="required">Model</label><br>
    <input name="invModel" id="invModel" type="text" <?php if(isset($invModel)){echo "value='$invModel'";}  ?> required><br>

    <label for="invDescription" class="required">Description</label><br>
    <textarea name="invDescription" id="invDescription" <?php if(isset($invDescription)){echo "value='$invDescription'";}  ?> required></textarea><br>

    <label for="invimage" class="required">Image Path</label><br>
    <input name="invimage" id="invimage" type="text" <?php if(isset($invimage)){echo "value='$invimage'";}  ?> required value="phpmotors/vehicles/images/no-image.png"><br>

    <label for="invThumbnail" class="required">Thumbnail Path</label><br>
    <input name="invThumbnail" id="invThumbnail" type="text" <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}  ?> required value="phpmotors/vehicles/images/no-image.png"><br>

    <label for="invPrice" class="required">Price</label><br>
    <input name="invPrice" id="invPrice" type="number" <?php if(isset($invPrice)){echo "value='$invPrice'";}  ?> required><br>

    <label for="invStock" class="required"># In Stock</label><br>
    <input name="invStock" id="invStock" type="text"<?php if(isset($invStock)){echo "value='$invStock'";}  ?> required><br>

    <label for="invColor" class="required">Color</label><br>
    <input name="invColor" id="invColor" type="text" <?php if(isset($invColor)){echo "value='$invColor'";}  ?> required><br>

    <input type="submit" name="submit" id="addbtn" value="Add Vehicle" class="button"> 
     <!-- Add the action name - value pair  -->
     <input type="hidden" name="action" value="submitVehicle">

</form>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>

