<?php
//reviews controller
session_start();
require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';
require_once '../model/uploads-model.php';
require_once '../model/reviews-model.php';
require_once '../library/functions.php';

// Get the array of classifications
$classifications = getClassifications();
// Build a navigation bar using the $classifications array
$navList = buildNav($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'newReview':
        $clientScreenName = filter_input(INPUT_POST, 'clientScreenName', FILTER_SANITIZE_STRING);
        $reviewtext = filter_input(INPUT_POST, 'reviewtext', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);


        //Check for missing data
        if(empty($clientId) || empty($invId) || empty($reviewtext)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            $_SESSION['message'] = $message;
            header("location: /phpmotors/vehicles/?action=vehicle-detail&invId=$invId");
            exit; 
        }
        $revOutcome = addReview($reviewtext, $invId, $clientId);
        // Check and report the result
        if($revOutcome === 1){
            $_SESSION['message'] = "Thanks for the review!";
            header("location: /phpmotors/vehicles/?action=vehicle-detail&invId=$invId");
            exit;
        } else {
            $_SESSION['message'] = "<p>Sorry $clientScreenName, but the review didn't upload. Please try again.</p>";
            header("location: /phpmotors/vehicles/?action=vehicle-detail&invId=$invId");
            exit;
        }
        break;
    case 'edit':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $reviewInfo = specificReview($reviewId);

        if (count($reviewInfo) < 1) {
            $message = 'Sorry, the review information could not be found.';
            $_SESSION['message'] = $message;
        }

        include '../view/edit-review.php';
        break;
    case 'update':
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $reviewtext = filter_input(INPUT_POST, 'reviewtext', FILTER_SANITIZE_STRING);       

        if(empty($reviewtext)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            $_SESSION['message'] = $message;
            header("location: /phpmotors/reviews/?action=edit&reviewId=$reviewId");
            exit;
        }

        $updateResult = updateReview($reviewId, $reviewtext);
        if ($updateResult === 1) {
            $message = "<p class='notice'>Congratulations, your review was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header("location: /phpmotors/reviews/?action=edit&reviewId=$reviewId");
            exit;
        } else {
            $message = "<p class='notice'>Error. your review was not updated.</p>";
            $_SESSION['message'] = $message;
            header("location: /phpmotors/reviews/?action=edit&reviewId=$reviewId");
            exit;
            }
        break;
    case 'confirmDelete':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $reviewInfo = specificReview($reviewId);

        if (count($reviewInfo) < 1) {
            $message = 'Sorry, the review information could not be found.';
            $_SESSION['message'] = $message;
        }
        include '../view/delete-review.php';
        break;
    case 'delete':
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = deleteReview($reviewId);
        if ($deleteResult) {
            $message = "<p class='notice'>Review was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/?action=adminPage');
            exit;
        } else {
            $message = "<p class='notice'>Error. your review was not deleted.</p>";
            $_SESSION['message'] = $message;
            header("location: /phpmotors/reviews/?action=confirmDelete&reviewId=$reviewId");
            exit;
            }
        break;
    default:        
        include '../view/admin.php';
        
        break;
   }