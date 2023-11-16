<?php

session_start();
include("../Config/DB.php");

if (isset($_POST['submitSet'])) {
    $village = $_POST['village'];
    $SetName = $_POST['Setname'];
    $maxFoods = 6; 
    
    $images = array();

    foreach ($_FILES['imgSet']['tmp_name'] as $key => $imgTmpName) {
        if ($_FILES['imgSet']['error'][$key] === UPLOAD_ERR_OK) {
            // Read the file content
            $img = file_get_contents($imgTmpName);
            $images[] = $img;
        } else {
            $_SESSION['error'] = "Error uploading file " . $key;
            header("location: indexingre.php");
            exit();
        }
    }
    $numImages = count($images);
    $maxImg = 4;
    
  
    for ($i = 1; $i <= $maxFoods; $i++) {
        $foodNameKey = 'foodName' . $i;
        if (!empty($_POST[$foodNameKey]) && empty($_POST['foodName' . ($i + 1)])) {
            $sql = $conn->prepare("INSERT INTO setfood(VillageSet, ImgSet1, ImgSet2, ImgSet3, ImgSet4, SetName, 
            FoodName0, FoodName1, FoodName2, FoodName3, FoodName4, FoodName5, FoodName6) 
            VALUES(:villageSet, :ImgSet1, :ImgSet2, :ImgSet3, :ImgSet4, :setName, 
            :foodName, :foodName1, :foodName2, :foodName3, :foodName4, :foodName5, :foodName6)");
            $sql->bindParam(":villageSet", $village);
            for ($g = 1; $g <= $maxImg; $g++) {
                for ($iii = 1; $iii <= $numImages; $iii++) {
                    $ImgSet = 'ImgSet'.$iii;
                    $sql->bindParam(":".$ImgSet, $images[$iii-1], PDO::PARAM_LOB);
                }
                for ($a = $g+1 ; $a <= $maxImg; $a++) {
                    $ImgSet = 'ImgSet'.$a;
                    $emptyValue = "";
                    $sql->bindParam(":".$ImgSet,$emptyValue);
                }
            }
            $sql->bindParam(":setName", $SetName);
            $sql->bindParam(":foodName", $_POST['foodName']);
            for ($j = 1; $j <= $i; $j++) {
                $foodName = 'foodName' . $j;
                $sql->bindParam(":" . $foodName, $_POST[$foodName]);
            }
            for ($j = $i + 1; $j <= $maxFoods; $j++) {
                $foodName = 'foodName' . $j;
                $emptyValue = "";
                $sql->bindParam(":" . $foodName, $emptyValue);
            }
            $executeResult = $sql->execute();

            if ($executeResult) {
                $_SESSION['success'] = "เพิ่มข้อมูลเรียบร้อย";
            } else {
                $_SESSION['error'] = "Data has not been inserted successfully";
            }
            header("location: indexSetFood.php");
            break; 
        }
    }
}

?>
