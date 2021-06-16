<?php
$a = "s PHP Motors, Inc.";
$title = $classificationName.$a;
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php';?>

<h1><?php echo $classificationName; ?> vehicles</h1>
<?php if(isset($message)){
 echo $message; }
?>
<?php if(isset($vehicleDisplay)){
 echo $vehicleDisplay;
} ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>





