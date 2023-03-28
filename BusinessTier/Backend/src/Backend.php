<?php
// Load the MongoDB PHP driver
require 'vendor/autoload.php';

// Connect to the MongoDB replica set
try { 
    $client = new MongoDB\Client(
        'mongodb://mongo1:27017,mongo2:27017,mongo3:27017/admin?replicaSet=rs0'
    );
} catch (MongoConnectionException $e) {
    die('Error connecting to MongoDB server');
} catch (MongoException $e) {
    die('Error: ' . $e->getMessage());
}

// Select the 'users' and 'codes' collections from the 'runners_crisps' database
$users = $client->RunnersDB->users;
$codes = $client->RunnersDB->codes;

// Check if the form has been submitted and if so, retrieve the code and best player name
if (isset($_POST['submit'])) {
    $code = strtolower(sanitize($_POST['code']));
    $bestPlayer = sanitize($_POST['best_player']);
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $address = sanitize($_POST['address']);

    // Check if the code exists in the 'codes' collection and has not been used before
    $result = $codes->findOne(['code' => $code]);
    if ($result->used === FALSE) {
        if ($result->football === TRUE) {
            // The code corresponds to a football prize, so send the user a voucher
            echo "VOUCHER";
        } else {
            // The code corresponds to a $10 discount prize
            echo "DISCOUNT";
        }

        // Insert the user's data into the 'users' collection for analytics
        $users->insertOne([
            'name' => $name,
            'email' => $email,
            'address' => $address,
            'best_player' => $bestPlayer
        ]);

    } else {
        // The code has already been used
        echo "Code has already been used";
    }
} else {
    // The form has not been submitted
    echo "Invalid form";
}

// Sanitize the input data to prevent SQL injection attacks
function sanitize($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>