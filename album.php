<?php
require './connection.php';
require './functions.php';


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the request body
    $data = json_decode(file_get_contents('php://input'), true);

    // Extract the variables
    $album_id = $data['album_id'];

    $album_title = $data['album_title'];

   

    // Prepare and execute the database query
    $sql="INSERT INTO album_titles (album_id,album_title)
    VALUES ('$album_id','$album_title')";

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
    
//     if($_SERVER["REQUEST_METHOD"] == "POST")
//     {
        
//         $imgs=['image1', 'image2'];
       
        
//          foreach($imgs as $img)
//         {
//             $fileName=$_FILES[$img]['name'];
//             echo " $fileName";

//             if(uploadImage($img, 5000000, "./images/", $fileName)); 
//             {
//                 $sql="INSERT INTO album_images (imag_name) VALUES ('$fileName')";

//                 if($db->query($sql))
//                 {
//                     echo json_encode(
//                         array(
//                             "status" => "success",
//                             "message" => "success"
//                         )
//                         );
//                 }   
//                 else
//                 {
//                     Error();
//                 }
//             }
//         }
        
//     }
// }
// // if(array_key_exists("addalbum", $_GET))
// // {
//     if($_SERVER["REQUEST_METHOD"] == "POST")
//     {
//         $albumtitle=$_POST['albumtitle'];
//         if($conn->query("INSERT INTO album_titles (album_title) VALUES ('$albumtitle')"))
//         {    
//         $albumtitle=$_POST['albumtitle'];
//             $fkID=$db->query("SELECT id FROM album_titles WHERE album_title='$albumtitle' ORDER BY album_title DESC LIMIT 1")->fetch_assoc();
//             $fk=$fkID['id'];
            
//             $albumImages=$_FILES['albumimage'];
            
//             for($i=0; $i<sizeof($albumImages['name']); $i++)
//             {   
//                 $fileName=$albumImages['name'][$i];
//                 $tempname=$albumImages['tmp_name'][$i];
//                 $filesize=$albumImages['size'][$i];

//                 $validExt=['jpg', 'jpeg', 'png'];
//                 $fileExt= strtolower(pathinfo($fileName, PATHINFO_EXTENSION));


//                 if(in_array($fileExt, $validExt))
//                 {
//                     if($filesize<50000001)
//                     {
//                         move_uploaded_file($tempname, "./images".$fileName);
                        
//                     }
//                     else
//                     {
//                         echo json_encode(
//                             array(
//                                 "status" => "error",
//                                 "message" => "Large Image Size"
//                             )
                    
//                             );
                            
//                     }
//                 }
//                 else
//                 {
//                     echo json_encode(
//                         array(
//                             "status" => "error",
//                             "message" => "Invalid Extension"
//                         )
//                         );
                        
//                 }

                
                
//                 echo ($fileName);
//                 $sql="INSERT INTO album_images (image_name, album_id)
//                 VALUES ('$fileName','$fk')";
//                 if( $db->query($sql))
//                 {
//                     echo json_encode(
//                         array(
//                             "status" => "success",  
//                             "message" => "success"
//                         )
//                     );
//                 }
//                 else
//                 {
//                     echo json_encode(
//                         array(
//                             "status" => "error",  
//                             "message" => "Database Error"
//                         )
//                     );
//                 }
//             }

//         }
//     }

//     if(array_key_exists("albumid", $_GET))
// {
//     $albumTitleId=$_GET['albumid'];

//     $sql="SELECT id, album_title FROM album_titles WHERE id='$albumTitleId'";
//     $result=$db->query($sql)->fetch_assoc();
//     $titleid= $result['id'];
    
//     $sql2="SELECT image_name FROM album_images WHERE album_id='$titleid'";
//     $result2= $db->query($sql2)->fetch_all(MYSQLI_ASSOC);
    
//     $imageNames=[];
//     foreach ($result2 as $row)
//     {
//         array_push($imageNames, $row['image_name']);
//     }
//     // $data=array(
//     //     "id" => $result['id'],
//     //     "album_title" =>$result['id'],
//     //     "album_images" => $result2

//     // );
//     echo (json_encode($data= array(
//         "id" => $titleid,
//         "album_title" => $result['album_title'],
//         "album_images" => $imageNames
//     )));


// }
