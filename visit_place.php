<?php
require './connection.php';
require './functions.php';


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");


if(array_key_exists("all", $_GET))
{
    getAll("pack_title");
}

if (array_key_exists("id", $_GET))
{   
    getOne( $_GET['id'], "pack_title");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["place"])) {
        $place = $_POST["place"];
    } else {
        $place = ""; // Set a default value if the place is not provided
    }

    if (isset($_FILES["image"]["name"])) {
        $fileName = $_FILES["image"]["name"];
    } else {
        $fileName = ""; // Set a default value if the image file name is not provided
    }

    if (uploadImage("image",5000000, "./images", $fileName)) {
        // Assuming the uploadImage function is defined correctly

        $sql = "INSERT INTO visit_place (place, image) VALUES ('$place', '$fileName')";

        if ($db->query($sql)) {
            $data = [
                "status" => "success",
                "message" => "Data added"
            ];
            echo json_encode($data);
        } else {
            $data = [
                "status" => "error",
                "message" => "Failed to insert data"
            ];
            echo json_encode($data);
        }
    } else {
        $data = [
            "status" => "error",
            "message" => "Failed to upload image."
        ];
        echo json_encode($data);
    }
}
if(array_key_exists("allpackagevisitplaces", $_GET))
{
    getALL("package_visit_place");
}

if(array_key_exists("packagevisitplacesid", $_GET))
{
    getOne($_GET['packagevisitplacesid'], "package_visit_place");
}

if(array_key_exists("deletepackagevisitplaces", $_GET))
{
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        deletedata($_POST['id'], "package_visit_place");
    }
}


if(array_key_exists("updatepackagevisitplaces", $_GET))
{
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        
    }
   
}


?>