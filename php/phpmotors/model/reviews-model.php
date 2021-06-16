<?php
//model for reviews
//add reviews to database
function addReview($reviewtext, $invId, $clientId) {
   $db = phpmotorsConnect();
   $sql = 'INSERT INTO reviews(reviewtext, invId, clientId) 
           VALUES (:reviewtext, :invId, :clientId)';
   $stmt = $db->prepare($sql);
   // The next three lines replace the placeholders in the SQL
   // statement with the actual values in the variables
   // and tells the database the type of data it is
   $stmt->bindValue(':reviewtext', $reviewtext, PDO::PARAM_STR);
   $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
   $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
   // Insert the data
   $stmt->execute();
   // Ask how many rows changed as a result of our insert
   $rowsChanged = $stmt->rowCount();
   // Close the database interaction
   $stmt->closeCursor();
   // Return the indication of success (rows changed)
   return $rowsChanged;
}

function inventoryReviews($invId) {
   $db = phpmotorsConnect();
   $sql = 'SELECT reviews.reviewtext, reviews.reviewDate, reviews.invId, clients.clientId, clients.clientFirstname, clients.clientLastname
    FROM reviews
    JOIN clients
    ON reviews.clientId = clients.clientId
    WHERE invId = :invId';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
   $stmt->execute();
   $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
   $stmt->closeCursor();
   return $reviews;
}

function clientReviews($clientId) {
   $db = phpmotorsConnect();
   $sql = 'SELECT reviews.reviewDate, reviews.invId, reviews.reviewId, inventory.invMake, inventory.invModel
    FROM reviews
    JOIN inventory
    ON reviews.invId = inventory.invId
    WHERE clientId = :clientId';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
   $stmt->execute();
   $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
   $stmt->closeCursor();
   return $reviews; 
}

function specificReview($reviewId) {
   $db = phpmotorsConnect();
   $sql = 'SELECT reviews.reviewDate, reviews.reviewtext, reviews.invId, reviews.reviewId, inventory.invMake, inventory.invModel
    FROM reviews
    JOIN inventory
    ON reviews.invId = inventory.invId
    WHERE reviewId = :reviewId';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
   $stmt->execute();
   $reviews = $stmt->fetch(PDO::FETCH_ASSOC);
   $stmt->closeCursor();
   return $reviews; 
}

function updateReview($reviewId, $reviewtext) {
   $db = phpmotorsConnect();
   $sql = 'UPDATE reviews SET reviewId = :reviewId, reviewtext = :reviewtext WHERE reviewId = :reviewId';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
   $stmt->bindValue(':reviewtext', $reviewtext, PDO::PARAM_STR);
   $stmt->execute();
   $rowsChanged = $stmt->rowCount();
   $stmt->closeCursor();
   return $rowsChanged;
}

function deleteReview($reviewId) {
   $db = phpmotorsConnect();
   $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
   $stmt->execute();
   $rowsChanged = $stmt->rowCount();
   $stmt->closeCursor();
   return $rowsChanged;
}

