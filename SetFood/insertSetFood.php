<?php 

session_start();
include ("../Config/DB.php");

if (isset($_POST['submitSet'])) {
    $village = $_POST['village'];
    $SetName = $_POST['Setname'];
    $foodname = $_POST['foodName'];
    $img = file_get_contents($_FILES['imgSet']['tmp_name']);
    


        
                    $sql = $conn->prepare("INSERT INTO setfood(VillageSet, ImgSet, SetName, FoodName) VALUES(:villageSet, :imgSet, :setName, :foodName)");
                    $sql->bindParam(":villageSet", $village);
                    $sql->bindParam(":imgSet",$img, PDO::PARAM_LOB);
                    $sql->bindParam(":setName", $SetName);
                    $sql->bindParam(":foodName", $foodname);
                    $sql->execute();

                    if ($sql) {
                        $_SESSION['success'] = "เพิ่มข้อมูลเรียบร้อย";;
                        header("location: indexSetFood.php");
                    } else {
                        $_SESSION['error'] = "Data has not been inserted successfully";
                        header("location: indexSetFood.php");
                    }
                }
            
        



?>