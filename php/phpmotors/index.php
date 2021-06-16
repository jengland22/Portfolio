<?php
// Get the database connection file
// Create or access a Session
session_start();
require_once 'library\connections.php';
// Get the PHP Motors model for use as needed
require_once 'model\main-model.php';
// Get the functions library
require_once 'library\functions.php';

// Get the array of classifications
$classifications = getClassifications();


//build the navagation list
$navList = buildNav();


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action){
  case 'template':
    include 'view/template.php'; 
    break;
  default:
    include 'view/home.php';
}
