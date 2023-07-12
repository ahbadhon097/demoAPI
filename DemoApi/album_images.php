<?php
require './connection.php';
require './functions.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// if(array_key_exists("addalbum", $_GET))
// {
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $albumtitle=$_POST['albumtitle'];
        if($db->query("INSERT INTO album_titles (album_title) VALUES ('$albumtitle')"))
        {    
        $albumtitle=$_POST['albumtitle'];
            $fkID=$db->query("SELECT album_id FROM album_titles WHERE album_title='$albumtitle' ORDER BY album_title DESC LIMIT 1")->fetch_assoc();
            $fk=$fkID['album_id'];
            
            $albumImages=$_FILES['image_name'];
            
            for($i=0; $i<sizeof($albumImages['image_name']); $i++)
            {   
                $fileName=$albumImages['image_name'][$i];
                $tempname=$albumImages['tmp_name'][$i];
                $filesize=$albumImages['size'][$i];

                $validExt=['jpg', 'jpeg', 'png'];
                $fileExt= strtolower(pathinfo($fileName, PATHINFO_EXTENSION));


                if(in_array($fileExt, $validExt))
                {
                    if($filesize<50000001)
                    {
                        move_uploaded_file($tempname, "./images/album/".$fileName);
                        
                    }
                    else
                    {
                        echo json_encode(
                            array(
                                "status" => "error",
                                "message" => "Large Image Size"
                            )
                    
                            );
                            
                    }
                }
                else
                {
                    echo json_encode(
                        array(
                            "status" => "error",
                            "message" => "Invalid Extension"
                        )
                        );
                        
                }

        
                echo ($fileName);
                $sql="INSERT INTO album_images (image_name, album_id)
                VALUES ('$fileName','$fk')";
                if( $db->query($sql))
                {
                    echo json_encode(
                        array(
                            "status" => "success",  
                            "message" => "success"
                        )
                    );
                }
                else
                {
                    echo json_encode(
                        array(
                            "status" => "error",  
                            "message" => "Database Error"
                        )
                    );
                }
            }

        }
    }
// }

if(array_key_exists("albumid", $_GET))
{
    $albumTitleId=$_GET['albumid'];

    $sql="SELECT album_id, album_title FROM album_titles WHERE album_id='$albumTitleId'";
    $result=$db->query($sql)->fetch_assoc();
    $titleid= $result['album_id'];
    
    $sql2="SELECT image_name FROM album_images WHERE album_id='$titleid'";
    $result2= $db->query($sql2)->fetch_all(MYSQLI_ASSOC);
    
    $imageNames=[];
    foreach ($result2 as $row)
    {
        array_push($imageNames, $row['image_name']);
    }
    // $data=array(
    //     "id" => $result['id'],
    //     "album_title" =>$result['id'],
    //     "album_images" => $result2

    // );
    echo (json_encode($data= array(
        "album_id" => $titleid,
        "album_title" => $result['album_title'],
        "album_images" => $imageNames
    )));


}



// // if(array_key_exists("packageimageadd", $_GET))
// //{
//     if($_SERVER["REQUEST_METHOD"] == "POST")
//     {
        
//         $imgs=['image1', 'image2', 'image3', 'image4', 'image5', 'imag6'];
       
        
//          foreach($imgs as $img)
//         {
//             $fileName=$_FILES[$img]['name'];
//             echo " $fileName";

//             if(uploadImage($img, 5000000, "./images/", $fileName));
//             {
//                 $sql="INSERT INTO album_images (image_name) VALUES ('$fileName')";

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
// //}

// if(array_key_exists("getallpackageimage", $_GET))
// {
//     getALL("package_main_images");
// }

// if(array_key_exists("packageimageid", $_GET))
// {
//     getOne($_GET["packageimageid"], "package_main_images");
// }

// if(array_key_exists("deletepackageimage", $_GET))
// {
//     if($_SERVER["REQUEST_METHOD"] == "POST")
//     {
//         $id=$_POST["id"];
        
//        deletedata($id, "package_main_images");
//     }
// }

