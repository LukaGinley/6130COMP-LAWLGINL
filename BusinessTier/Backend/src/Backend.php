<?php

// Load the MongoDB PHP library
require 'vendor/autoload.php';

// Set up connection to MongoDB server
try { 
    $client = new MongoDB\Client(
        'mongodb://data-mongo1:27017,data-mongo2:27017,data-mongo3:27017/admin?replicaSet=rs0'
    );
} catch (MongoConnectionException $e) {
    // If connection fails, stop the script and print an error message
    die('Error connecting to MongoDB server');
} catch (MongoException $e) {
    // If any other MongoDB exception occurs, stop the script and print the error message
    die('Error: ' . $e->getMessage());
}

// Create a variable for each collection in the database
$collection = $client->RunnersDatabase->codes; // collection for codes
$users = $client->RunnersDatabase->users; // collection for users

// Get user input from index.php form
$code = $_POST['code']; // 10 digit code entered by the user
$name = $_POST['name']; // name entered by the user
$email = $_POST['email']; // email entered by the user
$address = $_POST['address']; // address entered by the user
$bestplayer = $_POST['best_player']; // favorite player entered by the user

// Look up the code entered by the user in the codes collection
$result = $collection->findOne(array('code' => $code));

// Check if the code has already been redeemed by another user
if ($users->countDocuments(['code' => $code]) > 0) {
    // If the code has already been redeemed, show an error message and stop the script
    echo "Sorry, this code has already been used.";
    exit;
}

/*
If the code exists in the database and has not been redeemed, 
show the user the coupon and store their information in the users collection.
*/
if ($result != null && !$result['redeemed']) 
{
    // Get the coupon associated with the code entered by the user
    $coupon = $result['coupon'];
    // Mark the code as redeemed in the codes collection
    $collection->updateOne(array('code' => $code), array('$set' => array('redeemed' => true)));

    // Create an array with the user's information to be inserted into the users collection
    $insertUser = array(
        'name' => $name,
        'email' => $email,
        'address' => $address,
        'best_player' => $bestplayer,
        'code' => $code
    );
    
    // Insert the user's information into the users collection
    $users->insertOne($insertUser);
    
    // Show the user a message and their coupon code based on the value of the coupon retrieved earlier
    echo ("Coupon: ". $coupon);
    if ($coupon == "FREEBALL")
    {
        echo "Congratulations! You are one of our lucky winners and have won a free ball"; 
    } 
    else 
    {
        echo "Congratulations! You have got 10%</p>";
    }
} else {
    // If code has already been redeemed, display an error message to the user and exit script
    echo "Sorry, this code is invalid or has already been used.";
    exit;
}
?>
