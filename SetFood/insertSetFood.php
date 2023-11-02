<?php

session_start();
include("../Config/DB.php");

if (isset($_POST['submitSet'])) {
    $village = $_POST['village'];
    $SetName = $_POST['Setname'];
    $img = file_get_contents($_FILES['imgSet']['tmp_name']);

    $maxFoods = 6; 

    for ($i = 1; $i <= $maxFoods; $i++) {
        $foodNameKey = 'foodName' . $i;
        if (!empty($_POST[$foodNameKey]) && empty($_POST['foodName' . ($i + 1)])) {
            $sql = $conn->prepare("INSERT INTO setfood(VillageSet, ImgSet, SetName, 
            FoodName0, FoodName1, FoodName2, FoodName3, FoodName4, FoodName5, FoodName6) 
            VALUES(:villageSet, :imgSet, :setName, 
            :foodName, :foodName1, :foodName2, :foodName3, :foodName4, :foodName5, :foodName6)");
            $sql->bindParam(":villageSet", $village);
            $sql->bindParam(":imgSet", $img, PDO::PARAM_LOB);
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
