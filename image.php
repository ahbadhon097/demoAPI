<?php
require './connection.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the request body
    $data = json_decode(file_get_contents('php://input'), true);
}

if(array_key_exists("packageimageadd", $_GET))
{
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        
        $imgs=['img1', 'img2', 'img3', 'img4', 'img5', 'img6'];
        
        
        foreach($imgs as $img)
        {
            $file_Name=$_FILES[$img]['name'];

            if(uploadImage($img, 5000000, "./images/packageMainImages/", $file_Name));
            {
                $sql="INSERT INTO img_packages (file_name) VALUES ('$file_Name')";
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
                    getErrorMsg();
                }
            }
        }
        
    }
}

if(array_key_exists("getallpackageimage", $_GET))
{
    getALL("img_packages");
}

if(array_key_exists("packageimageid", $_GET))
{
    getOne($_GET["packageimageid"], "img_packages");
}

if(array_key_exists("deletepackageimage", $_GET))
{
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $id=$_POST["id"];
        
       deletedata($id, "img_packages");
    }
}