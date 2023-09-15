<?php 

session_start();
require_once "config/DB.php";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $province = $_POST['province'];
    $district = $_POST['district'];
    $subdistrict = $_POST['subdistrict'];
    $img = file_get_contents($_FILES['img']['tmp_name']);
    $postalcode = $_POST['postalCode'];
    
    

        /*$allow = array('jpg', 'jpeg', 'png');
        $extension = explode('.', $img['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
        $filePath = 'Upload/'.$fileNew;*/


                    $sql = $conn->prepare("INSERT INTO user(Name, Img, Province, District , Subdistrict, PostalCode) VALUES(:name, :img, :province, :district ,:subdistrict, :postalcode)");
                    $sql->bindParam(":name", $name);
                    $sql->bindParam(":img", $img, PDO::PARAM_LOB);
                    $sql->bindParam(":province", $province);
                    $sql->bindParam(":district", $district);
                    $sql->bindParam(":subdistrict", $subdistrict);
                    $sql->bindParam(":postalcode", $postalcode);
                    $sql->execute();

                    if ($sql) {
                        $_SESSION['success'] = "Data has been inserted successfully";
                        header("location: index.php");
                    } else {
                        $_SESSION['error'] = "Data has not been inserted successfully";
                        header("location: index.php");
                    }
            
            }
        



?>