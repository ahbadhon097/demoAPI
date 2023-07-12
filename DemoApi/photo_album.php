<?php
require './connection.php';
require './functions.php';


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$app->post('/albums', function ($request, $response) {
    // Get the raw JSON data
    $jsonData = file_get_contents('php://input');

    // Decode the JSON into an associative array
    $data = json_decode($jsonData, true);

    // Get album name from the JSON data
    $albumName = $data['album_name'];

    // Get the base64-encoded image data from the JSON data
    $imageData = $data['image'];

    // Decode the base64 image data into binary
    $imageData = base64_decode($imageData);

    // Generate a unique filename
    $directory = '/images/';
    $filename = uniqid() . '.jpg';

    // Save the image data to the server
    $filePath = $directory . $filename;
    file_put_contents($filePath, $imageData);

    // Insert album information into the database
    $sql = "INSERT INTO albums (album_name, image_path) VALUES (:albumName, :imagePath)";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':albumName', $albumName);
    $stmt->bindParam(':imagePath', $filePath);
    $stmt->execute();

    // Return a success response
    $data = ['message' => 'Album created successfully'];
    return $response->withJson($data, 201);
});

