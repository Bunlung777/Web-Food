<?php 

session_start();
include ("../Config/DB.php");


if (isset($_POST['submitFood'])) {
    $foodname = $_POST['Foodname'];
    $img = file_get_contents($_FILES['imgSet']['tmp_name']);
    


        
                    $sql = $conn->prepare("INSERT INTO food(ImgFood, FoodName) VALUES( :imgSet, :foodname)");
                    $sql->bindParam(":imgSet",$img, PDO::PARAM_LOB);
                    $sql->bindParam(":foodname", $foodname);
                    $sql->execute();

                    if ($sql) {
                        $_SESSION['success'] = "เพิ่มข้อมูลเรียบร้อย";
                        header("location: Foodindex.php");
                    } else {
                        $_SESSION['error'] = "Data has not been inserted successfully";
                        header("location: Foodindex.php");
                    }
                }
            
        



?>