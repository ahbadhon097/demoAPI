<?php
require './connection.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the request body
    $data = json_decode(file_get_contents('php://input'), true);

    // Extract the variables
    $amount = $data['amount'];
    $date = $data['date'];
    
    // Prepare and execute the database query
    $sql="INSERT INTO installment (amount,date)
    VALUES ('$amount', '$date')";

     if($db->query($sql))
    {   $data=[
            "status" => "success",
            "message" => "data added"
        ];
        echo json_encode($data);
    }
    else
    {
        getErrorMsg();
    }
}
else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('message' => 'Invalid request method.'));
}





