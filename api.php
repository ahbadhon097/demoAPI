<?php
require './connection.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the request body
    $data = json_decode(file_get_contents('php://input'), true);

    // Extract the variables
    $maintitle = $data['maintitle'];
    $triptype = $data['triptype'];
    $country = $data['country'];
    $area = $data['area'];
    $destination = $data['destination'];
    $price = $data['price'];
    $discount = $data['discount'];

    // Prepare and execute the database query
    $sql="INSERT INTO package_title (maintitle,triptype,country,area,destination,price,discount)
    VALUES ('$maintitle', '$triptype', '$country', '$area', '$destination', '$price', '$discount')";

     if($db->query($sql))
    {   $data=[
            "status" => "success",
            "message" => "data added"
        ];
        echo json_encode($data);
    }
    else
    {
       // getErrorMsg();
    }
}

//   //  try {
//         $statement->execute();
//         http_response_code(201); // Created
//         echo json_encode(array('message' => 'Trip data inserted successfully.'));
//     } catch (PDOException $e) {
//         http_response_code(500); // Internal Server Error
//         echo json_encode(array('message' => 'Failed to insert trip data.'));
//     }
//} 

else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('message' => 'Invalid request method.'));
}

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
        //getErrorMsg();
    }
}




