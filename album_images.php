<?php
require './connection.php';
require './functions.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");



// if(array_key_exists("packageimageadd", $_GET))
//{
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        
        $imgs=['image1', 'image2', 'image3', 'image4', 'image5', 'imag6'];
       
        
         foreach($imgs as $img)
        {
            $fileName=$_FILES[$img]['name'];
            echo " $fileName";

            if(uploadImage($img, 5000000, "./images/", $fileName));
            {
                $sql="INSERT INTO album_images (image_name) VALUES ('$fileName')";

                if($db->query($sql))
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
                    Error();
                }
            }
        }
        
    }
//}

if(array_key_exists("getallpackageimage", $_GET))
{
    getALL("package_main_images");
}

if(array_key_exists("packageimageid", $_GET))
{
    getOne($_GET["packageimageid"], "package_main_images");
}

if(array_key_exists("deletepackageimage", $_GET))
{
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $id=$_POST["id"];
        
       deletedata($id, "package_main_images");
    }
}

