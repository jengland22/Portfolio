<?php
$a = "s PHP Motors, Inc.";
$title = $invModel.$a;
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php';?>
<div class="detailsPage">
<?php if(isset($message)){
 echo $message;
}
?>

<?php if(isset($vehicleDetails)){
 echo $vehicleDetails;
 echo $thumbnailDisplay;
} ?>

<div class=customerReviews>
<h2>Customer Reviews</h2>
<?php 
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    echo '<p>You must <a href="../accounts/?action=login-page">login</a> to write a review.</p>';
    }
    else {
        if(isset($message)){
            echo $message;
        }
        echo "<h2>Review the $invMake $invModel </h2><br>";
        echo $reviewForm;
        echo "<hr>";
    }
if ($reviewDisplay > 1){
    echo $reviewDisplay;
}
else
{
    echo "<p>Be the first to write a review.</p>";
} 
?>
</div>

</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>
