<!-- controller for accounts -->
<?php
// Create or access a Session
session_start();
// Get the database connection file
require_once '..\library\connections.php';
// Get the PHP Motors model for use as needed
require_once '..\model\main-model.php';
// Get the accounts model
require_once '..\model\accounts-model.php';
// get the review model
require_once '..\model\reviews-model.php';
// Get the functions library
require_once '..\library\functions.php';

// Get the array of classifications
$classifications = getClassifications();

//build the navagation list
$navList = buildNav();


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

// Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
   }

switch ($action) {
    case 'login-page':
        include '../view/login.php';
        break;
    case 'registration':
        include '../view/registration.php';
        break;
    case 'Login':
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientEmail = checkEmail($clientEmail);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $passwordCheck = checkPassword($clientPassword);

        // Run basic checks, return if errors
        if (empty($clientEmail) || empty($passwordCheck)) {
            $_SESSION['message'] = '<p class="notice">Please provide a valid email address and password.</p>';
            include '../view/login.php';
            exit;
        }
        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if(!$hashCheck) {
            $_SESSION['message'] = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // Send them to the admin view abd build reviews
        $clientData = $_SESSION['clientData'];
        $clientId = $clientData['clientId'];
        $reviews = clientReviews($clientId);
        $clientReviewDisplay = buildClientReview($reviews);
        include '../view/admin.php';
        exit;
    case 'register':
        // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        $existingEmail = checkExistingEmail($clientEmail);

        //checking for existing email in table
        if($existingEmail){
            $_SESSION['message'] = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
            include '../view/login.php';
            exit;
        }

        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/registration.php';
            exit; 
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);
        // Check and report the result
        if($regOutcome === 1){
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
            header('Location: /phpmotors/accounts/?action=login-page');
            exit;
        } else {
            $_SESSION['message'] = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            header('location: ../view/registration.php');
            exit;
        }
    case 'update':
        $clientId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $clientInfo = getClientInfo($clientId);
        if(count($clientInfo)<1){
            $message = 'Sorry, no user information could be found.';
        }
        include '../view/client-update.php';
        exit;
        break;
    case 'updateInfo':
        // Filter and store the data
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        if ($clientEmail != $_SESSION['clientData']['clientEmail']){
            $clientEmail = checkEmail($clientEmail);
            $existingEmail = checkExistingEmail($clientEmail);
            //checking for existing email in table
            if($existingEmail){
                $message = '<p class="notice">That email address already exists.</p>';
                include '../view/client-update.php';
                exit;
            }
        }

        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
            exit; 
        }

        // Send the data to the model
        $updateOutcome = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);
        // Check and report the result
        if($updateOutcome){
            $_SESSION['message'] = "Thanks $clientFirstname. Your information has been updated.";
            $clientData = getClientInfo($clientId);
            // A valid user exists, log them in
            $_SESSION['loggedin'] = TRUE;
            // Store the array into the session
            $_SESSION['clientData'] = $clientData;
            header('Location: /phpmotors/accounts/');
            exit;
        } 
        else {
            $message = "<p>Sorry $clientFirstname, but the update failed. Please try again.</p>";
            include '../view/client-update.php';
            exit;
        }
    case 'updatePassword':
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        // Filter and store the data
        $checkPassword = checkPassword($clientPassword);
        // Check for missing data
        if(empty($checkPassword)){
            $message = '<p>Please enter new password.</p>';
            include '../view/client-update.php';
            exit; 
        }
        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        // Send the data to the model
        $PassUpdateOutcome = updatePassword($hashedPassword, $clientId);
        // Check and report the result
        if($PassUpdateOutcome){
            $_SESSION['message'] = "Password Updated.";
            header('Location: ../accounts/');
            exit;
        } else {
            $passMessage = "<p>Sorry the password update failed. Please try again.</p>";
            header('location: ../view/client-update.php');
            exit;
        }
    case 'Logout':
        // remove all session variables
        session_unset();
        // destroy the session
        session_destroy();
        header('location: ../../phpmotors');
        exit;
    case 'adminPage':
        $clientData = $_SESSION['clientData'];
        $clientId = $clientData['clientId'];
        $reviews = clientReviews($clientId);
        $clientReviewDisplay = buildClientReview($reviews);
        include '../view/admin.php';
        exit;
    default: 
        include '../view/admin.php';


}