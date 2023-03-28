<?php
require 'vendor/autoload.php';

// Setup database
try { 
    $client = new MongoDB\Client(
        'mongodb://mongo1:27017,mongo2:27017,mongo3:27017/admin?replicaSet=rs0'
    );
} catch (MongoConnectionException $e) {
    die('Error connecting to MongoDB server');
} catch (MongoException $e) {
    die('Error: ' . $e->getMessage());
}
    
$users = $client->runners_crisps->users;
$codes = $client->runners_crisps->codes;

// Matches 10 digit hex code
$CODE_REGEX = "/^[a-f0-9]{10}$/";

// Check if the form has been submitted and if so, get the code and playername
if (isset($_POST['submit'])) {
    $code = strtolower(sanatize($_POST['code']));
    $bestPlayer = sanatize($_POST['best_player']);

    $name = sanatize($_POST['name']);
    $email = sanatize($_POST['email']);
    $address = sanatize($_POST['address']);

    // Result can be NULL but we can just fallback to else
    $result = $codes->findOne(['code' => $code]);

    // We check the code has not been used
    if ($result->used === FALSE) {
        if ($result->football === TRUE) {
            // They won a football we should email them the code
            echo "VOUCHER";
        } else {
            // They won a 10$ discount
            echo "DISCOUNT";
        }

        // Now we can store their data for analytics, though im pretty sure this violates GDPR since we haven't got a privacy policy
        $users->insertOne([
            'name' => $name,
            'email' => $email,
            'address' => $address,
            'playerName' => $bestPlayer
        ]);

    } else {
        echo "Code has already been used";
    }
} else {
    echo "Invalid form";
}

?>