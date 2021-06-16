<?php
$title="Delete Review";
$date = strtotime($reviewInfo['reviewDate']);
$formattedDate = date('d F, Y', $date);
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/header.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/nav.php';?>

<h1 class="title"><?php echo "$reviewInfo[invMake] $reviewInfo[invModel]"?> Review </h1>
<?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
   }
?>

<h2>Reviewed on <?php echo "$formattedDate" ?></h2>
<form method="post" action="/phpmotors/reviews/">

   <div class=updateReviews>
      <h2>Review Text</h2>

      <textarea name='reviewtext' id='reviewtext' readonly> <?php echo "$reviewInfo[reviewtext]"?></textarea><br>

      <input type='submit' name='submit' id='delete' value='Delete Review' class='button'>
      <!--add action name and value pair-->
      <input type='hidden' name='action' value='delete'>
      <input type='hidden' name='reviewId' value='<?php echo "$reviewInfo[reviewId]"?>'>
</div>
</form>



<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/common/footer.php'; ?>





