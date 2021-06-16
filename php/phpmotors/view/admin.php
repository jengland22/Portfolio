<?php
$title="admin";
if(!$_SESSION['loggedin']){
    header('Location: /phpmotors');
    }
    $clientData = $_SESSION['clientData'];
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php';?>

<h1 class="title">Welcome <?php echo $clientData['clientFirstname'];?>! </h1>
<?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
   }
?>
<h2>You are logged in</h2>
<p>Update account information <a href="../accounts/index.php?action=update&id=<?php echo $clientData['clientId'];?>">here</a></p>

<?php
    if($clientData['clientLevel'] > 1){
        echo '<h2>Vehicle Managment</h2>';
        echo '<p>Update vehicles list at the link below<p>';
        echo '<p>Vist our vehicles page <a href="../vehicles/">here</a></p>';
    }

    if($clientReviewDisplay > 1){
        echo $clientReviewDisplay;
    }


include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>





