<?php
//This is the Main PHP Motors Model
function getClassifications(){
    // create connection object from the phpmotors connection function
    $db = phpmotorsConnect();
    // the SQL statement to be used with the database
    $sql = 'SELECT classificationName, classificationId FROM carClassification ORDER BY classificationName ASC';
    //next line creates the prepare statment using the phpmotors connection
    $stmt = $db->prepare($sql);
    //next line runs prepared statement
    $stmt -> execute();
    // next line gets data from the database and
    // stores it as an array in the $classifications variable
    $classifications = $stmt->fetchAll();
    //this next line sends the array of data back to where the function
    $stmt->closeCursor();
    //the next line sends the array of data back to where the function
    //was called (this should be the controller)
    return $classifications;
}
