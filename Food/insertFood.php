<?php

session_start();
include("../Config/DB.php");

if (isset($_POST['submitFood'])) {
    $foodName = $_POST['Foodname'];
    $detail = $_POST['detail'];
    $img = file_get_contents($_FILES['imgSet']['tmp_name']);

    if(isset($_POST['ingredients'])&& empty($_POST['ingredients1'])){
        $sql = $conn->prepare("INSERT INTO food(ImgFood, FoodName, Detail, Ingredients0) VALUES(:ImgFood, :FoodName, :Detail, :ingredients)");
        $sql->bindParam(":ImgFood", $img, PDO::PARAM_LOB);
        $sql->bindParam(":FoodName", $foodName);
        $sql->bindParam(":Detail", $detail);
        $sql->bindParam(":ingredients", $_POST['ingredients']);
                    $sql->execute();

                    if ($sql) {
                        $_SESSION['success'] = "";
                        header("location: Foodindex.php");
                    } else {
                        $_SESSION['error'] = "Data has not been inserted successfully";
                        header("location: Foodindex.php");
                    }
    }else{

    $maxFoods = 12; 
    for ($i = 1; $i <= $maxFoods; $i++) {
        $ingredientsKey = 'ingredients' . $i;
        if (!empty($_POST[$ingredientsKey]) && empty($_POST['ingredients' . ($i + 1)])) {
            $sql = $conn->prepare("INSERT INTO food(ImgFood, FoodName, Detail,
            Ingredients0, Ingredients1, Ingredients2, Ingredients3, Ingredients4, Ingredients5, Ingredients6,
            Ingredients7, Ingredients8, Ingredients9, Ingredients10, Ingredients11, Ingredients12) 
            VALUES(:ImgFood, :FoodName, :Detail, 
            :ingredients, :ingredients1, :ingredients2, :ingredients3, :ingredients4, :ingredients5, :ingredients6,
            :ingredients7, :ingredients8, :ingredients9, :ingredients10, :ingredients11, :ingredients12)");
            $sql->bindParam(":ImgFood", $img, PDO::PARAM_LOB);
            $sql->bindParam(":FoodName", $foodName);
            $sql->bindParam(":Detail", $detail);
            $sql->bindParam(":ingredients", $_POST['ingredients']);
            for ($j = 1; $j <= $i; $j++) {
                $ingredients = 'ingredients' . $j;
                $sql->bindParam(":" . $ingredients, $_POST[$ingredients]);
            }
            for ($j = $i + 1; $j <= $maxFoods; $j++) {
                $ingredients = 'ingredients' . $j;
                $emptyValue = "";
                $sql->bindParam(":" . $ingredients, $emptyValue);
            }
            $executeResult = $sql->execute();

            if ($executeResult) {
                $_SESSION['success'] = "เพิ่มข้อมูลเรียบร้อย";
            } else {
                $_SESSION['error'] = "Data has not been inserted successfully";
            }
            header("location: Foodindex.php");
            break; // Break the loop after the insertion
        }
    }
}
}


?>