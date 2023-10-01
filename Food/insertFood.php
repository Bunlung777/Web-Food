<?php 

session_start();
include ("../Config/DB.php");


if (isset($_POST['submitFood'])) {
    $foodname = $_POST['Foodname'];
    $detail = $_POST['detail'];
    $img = file_get_contents($_FILES['imgSet']['tmp_name']);
    


        
                    $sql = $conn->prepare("INSERT INTO food(ImgFood, FoodName,Detail) VALUES( :imgSet, :foodname,:detail)");
                    $sql->bindParam(":imgSet",$img, PDO::PARAM_LOB);
                    $sql->bindParam(":foodname", $foodname);
                    $sql->bindParam(":detail", $detail);
                    $sql->execute();

                    if ($sql) {
                        $_SESSION['success'] = "";
                        header("location: Foodindex.php");
                    } else {
                        $_SESSION['error'] = "Data has not been inserted successfully";
                        header("location: Foodindex.php");
                    }
                }
            
        



?>