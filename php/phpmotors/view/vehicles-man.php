<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
    header('location: /phpmotors/');
    exit;
}
if (isset($_SESSION['message'])) {
$message = $_SESSION['message'];
}
$title="Vehicle Management";
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php';?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php';?>

<h1 class="title">Vehicle Management</h1>

<ul>
    <li>
        <a title="Add Classification" href="http://localhost/phpmotors/vehicles/index.php?action=addClassification">Add Classification</a><br>
    </li>
    <li>
        <a title="Add Vehicle" href="http://localhost/phpmotors/vehicles/index.php?action=addVehicle">Add Vehicle</a>
    </li>

</ul>

<?php
if (isset($message)) { 
 echo $message; 
} 
if (isset($classificationList)) { 
 echo '<h2>Vehicles By Classification</h2>'; 
 echo '<p>Choose a classification to see those vehicles</p>'; 
 echo $classificationList; 
}
?>
<noscript>
<p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
</noscript>
<table id="inventoryDisplay"></table>


<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
<script src="../js/inventory.js"></script>
<?php unset($_SESSION['message']); ?>
