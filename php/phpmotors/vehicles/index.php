<?php
// controller for vehicles
// Create or access a Session
session_start();
// Get the database connection file
require_once '..\library\connections.php';
// Get the PHP Motors model for use as needed
require_once '..\model\main-model.php';
// Get the accounts model
require_once '..\model\vehicles-model.php';
// Get the functions library
require_once '../library/functions.php';
// Get uploads model
require_once '..\model\uploads-model.php';
// get reviews model
require_once '..\model\reviews-model.php';

// Get the array of classifications
$classifications = getClassifications();

//build the navagation list
$navList = buildNav();

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}
switch ($action) {
    case 'addClassification':
        include '../view/add-classification.php';
        break;
    case 'addVehicle':
        include '../view/add-vehicle.php';
        break;
    case 'submitClass':
        // Filter and store the data
        $classificationName = filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING);
        // Check for missing data
        if(empty($classificationName)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/add-classification.php';
            exit; 
        }
        // Send the data to the model
        $classOutcome = classClient($classificationName);
        // Check and report the result
        if($classOutcome === 1){
            Header('Location: ../vehicles');
            exit;
        } else {
            $message = "<p>Sorry $classificationName wasn't added. Please try again.</p>";
            include '../view/add-classification.php';
            exit;
        }
    case 'submitVehicle':
        // Filter and store the data
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invimage = filter_input(INPUT_POST, 'invimage', FILTER_SANITIZE_URL);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_URL);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        // Check for missing data
        if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invimage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/add-vehicle.php';
            exit; 
        }
        // Send the data to the model
        $vehicleOutcome = vehicleClient($invMake,$invModel,$invDescription,$invimage,$invThumbnail,$invPrice,$invStock,$invColor,$classificationId);
        // Check and report the result
        if($vehicleOutcome === 1){
            $message = "<p>Thanks for adding $invMake.</p>";
            include '../view/add-vehicle.php';
            exit;
        } else {
            $message = "<p>Sorry $invMake wasn't added. Please try again.</p>";
            include '../view/add-vehicle.php';
            exit;
        }
    /* * ********************************** 
    * Get vehicles by classificationId 
    * Used for starting Update & Delete process 
    * ********************************** */ 
    case 'getInventoryItems': 
        // Get the classificationId 
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
        // Fetch the vehicles by classificationId from the DB 
        $inventoryArray = getInventoryByClassification($classificationId); 
        // Convert the array to a JSON object and send it back 
        echo json_encode($inventoryArray); 
        break;
    case 'mod':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(count($invInfo)<1){
            $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-update.php';
        exit;
        break;
    case 'del':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
                $message = 'Sorry, no vehicle information could be found.';
            }
            include '../view/vehicle-delete.php';
            exit;
            break;
    case 'updateVehicle':
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        
        if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || 
        empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/vehicle-update.php';
            exit;
        }

        $updateResult = updateVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $invId);
        if ($updateResult) {
            $message = "<p class='notice'>Congratulations, the $invMake $invModel was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='notice'>Error. the $invMake $invModel was not updated.</p>";
                include '../view/vehicle-update.php';
                exit;
            }
    break;
    case 'deleteVehicle':
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        
        $deleteResult = deleteVehicle($invId);
        if ($deleteResult) {
            $message = "<p class='notice'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='notice'>Error: $invMake $invModel was not
        deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        }
        break;
    case 'classification':
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
        $vehicles = getVehiclesByClassification($classificationName);
        if(!count($vehicles)){
            $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
        } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }
        include '../view/classification.php';
        break;
    case 'vehicle-detail':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $invMake = filter_input(INPUT_GET, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_GET, 'invModel', FILTER_SANITIZE_STRING);
        $vehicle = getVehicleById($invId);
        $thumbnail = getThumbnails($invId);
        $reviews = inventoryReviews($invId);


        if(!count($vehicle)){
            $message = "<p class='notice'>Sorry, that vehicle could not be found.</p>";
        } else {
            if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
                $screenName = "newUser";
                $reviewForm = buildReviewForm($invId, $screenName, $invId);
            }
            else {
                // $clientData = getClientInfo($)
                $clientFirstname = $_SESSION['clientData']['clientFirstname'];
                $clientLastname = $_SESSION['clientData']['clientLastname'];
                $screenName = substr($clientFirstname,0,1).$clientLastname;
                $reviewForm = buildReviewForm($invId, $screenName, $_SESSION['clientData']['clientId']);
            }
            $vehicleDetails = buildVehicleDetailsDisplay($vehicle);
            $thumbnailDisplay = buildThumbnailDisplay($thumbnail);
            $reviewDisplay = buildReview($reviews);
        }
        include '../view/vehicle-detail.php';
        break;
    default:
        $classificationList = buildClassificationList($classifications);
        include '../view/vehicles-man.php';
        exit;
        break;

}