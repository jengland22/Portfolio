INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword, clientLevel, comment) 
VALUES ('Tony', 'Stark', 'tony@starkent.com', 'Iam1ronM@n', 1, '"I am the real Ironman"');

UPDATE clients
SET clientLevel = '3'
WHERE clientLastname = 'Stark' AND clientFirstname = 'Tony';

UPDATE inventory
SET    invDescription = REPLACE(invDescription, 'small interiors', 'spacious interior')
WHERE  invMake = "GM" AND invModel = "Hummer";

SELECT inventory.invModel
FROM inventory
INNER JOIN carclassification ON carclassification.classificationId=inventory.classificationId
WHERE classificationName = "SUV";

DELETE FROM inventory
where inventory.invModel = 'Wrangler'
AND inventory.invMake = 'Jeep';

UPDATE inventory
SET inventory.invImage=concat('/phpmotors',inventory.invImage)
, inventory.invThumbnail=concat('/phpmotors',inventory.invThumbnail);