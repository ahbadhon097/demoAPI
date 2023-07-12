<?php
require './connection.php';
require './functions.php';


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the request body
    $data = json_decode(file_get_contents('php://input'), true);
    if(array_key_exists("addinstallment", $_GET))
{
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
    
        $installmentData= json_decode(file_get_contents('php://input'), true);
        $amount=NULL;
        $date=NULL;
        foreach($installmentData as $obj )
        {
            $amount= $obj["amount"];
            $date=$obj["date"];
            
            $sql="INSERT INTO installment (amount, installment_date) 
            VALUES ('$amount', '$date')";
            if(!$conn->query($sql))
            {
                //getErrorMsg();
                
            }
        }
        echo json_encode(
            array(
                "status" => "success",
                "message" => "success"
            )
            );
       

    }    

}

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
else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('message' => 'Invalid request method.'));
}





