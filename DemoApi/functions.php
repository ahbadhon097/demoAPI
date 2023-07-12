<?php

require './connection.php';


function getALL($tablename)
{   
    global $db;

    $sql="SELECT * FROM $tablename";
    
    $result=$db->query($sql)->fetch_all(MYSQLI_ASSOC);
    if(!empty($result)){
        echo json_encode($result);
    }
    else{
        Error();
    }
}


function getOne($id, $tablename)
{   global $db;

    $sql="SELECT * FROM $tablename WHERE id='$id'";
    $result=$db->query($sql)->fetch_assoc();
    
    if(!empty($result)){
        echo json_encode($result);
    }
     else
     {
         getErrorMsg();
    }
}

function uploadImage($imagename, $acceptablesize, $cdnpath, $fileName)
{           
            $tempname=$_FILES[$imagename]['tmp_name'];
            $filesize=$_FILES[$imagename]['size'];

            $validExt=['jpg', 'jpeg', 'png'];
            $fileExt= strtolower(pathinfo($fileName, PATHINFO_EXTENSION));


            if(in_array($fileExt, $validExt))
            {
                if($filesize<$acceptablesize)
                {
                    move_uploaded_file($tempname, $cdnpath.$fileName);
                    return true;
                }
                else
                {
                    echo json_encode(
                        array(
                            "status" => "error",
                            "message" => "Large Image Size"
                        )
                
                        );
                        return false;
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
                    return false;
            }
}



function deletedata($id, $tablename){
        global $db;

        $sql="DELETE FROM $tablename WHERE id='$id'";
        if($db->query($sql))
        {
            echo json_encode(
                array(
                    "status" => "success",
                    "message" => "success"
                )
                );
        }else
        {
            Error(); 
        }
}

function Error(){
    echo json_encode(array(
        "status" => "error",
        "message" => "data not found"
    ));
}

?>