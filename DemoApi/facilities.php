<?php
require './connection.php';
require './functions.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the request body
    $data = json_decode(file_get_contents('php://input'), true);

    // Extract the variables
    $flights =(int) $data['flight'];
    $hotel = (int)$data['hotel'];
    $food = (int)$data['food'];
    $transport = (int)$data['transport'];

   

    // Prepare and execute the database query
    $sql="INSERT INTO facilities (flight,hotel,food,transport)
    VALUES ('$flights', '$hotel', '$food','$transport')";

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

// // if(array_key_exists("allfacilities", $_GET))
// // {
// //     getALL("facilities");
// // }

// // if(array_key_exists("facilitiesid", $_GET))
// // {   
    
// //     getOne($_GET['facilitiesid'], "facilities" );

// // }

// // if(array_key_exists("deletefacilities", $_GET))
// // {
// //     if($_SERVER["REQUEST_METHOD"] == "POST")
// //         {
            
// //             deletedata($_POST["id"], "facilities" );
// //         }
// // }

// // if(array_key_exists("updatefacilities", $_GET))
// // {
//     if($_SERVER["REQUEST_METHOD"] == "POST")
//     {
//         $data=json_decode(file_get_contents("php://input"), true);
//         $facilityArray=array_fill(0, 4, false);
//          echo " $data";
//         if(in_array("flights", $data['arr']))
//         {

//             $facilityArray[0]=true;
//         }
        
//         if(in_array("hotel",$data['arr']))
//         {
//             $facilityArray[1]=true;
//         }
        
//         if(in_array("food",$data['arr']))
//         {
//             $facilityArray[2]=true;
//         }
        
//         if(in_array("transport",$data['arr']))
//         {
//             $facilityArray[3]=true;
//         }
        
//         $id=$data['id'];
//         $sql="UPDATE facilities SET flight='$facilityArray[0]', hotel='$facilityArray[1]', 
//         food='$facilityArray[2]', transport='$facilityArray[3]' WHERE id='$id'";
    
//         if($db->query($sql))
//         {
//             echo json_encode(
//                 array(
//                     "status" => "success", 
//                     "message" => "success"
//                 )
//             );
//         }
//         else
//         {
//             echo json_encode(
//                 array(
//                     "status" => "error",  
//                     "message" => "Database Error"
//                 )
//             );
//         }
//     }
    
