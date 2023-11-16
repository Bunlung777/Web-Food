<?php

session_start();
include("../Config/DB.php");

if (isset($_POST['submitFood'])) {
    $foodName = $_POST['Foodname'];
    $detail = $_POST['detail'];
    // $img = file_get_contents($_FILES['imgSet']['tmp_name']);

    $images = array();

    foreach ($_FILES['ImgFood']['tmp_name'] as $key => $imgTmpName) {
        if ($_FILES['ImgFood']['error'][$key] === UPLOAD_ERR_OK) {
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

    // if(isset($_POST['ingredients'])&& empty($_POST['ingredients1'])){
    //     $sql = $conn->prepare("INSERT INTO food(ImgFood1, FoodName, Detail, Ingredients0) VALUES(:ImgFood, :FoodName, :Detail, :ingredients)");
    //     $sql->bindParam(":ImgFood", $img, PDO::PARAM_LOB);
    //     $sql->bindParam(":FoodName", $foodName);
    //     $sql->bindParam(":Detail", $detail);
    //     $sql->bindParam(":ingredients", $_POST['ingredients']);
    //                 $sql->execute();

    //                 if ($sql) {
    //                     $_SESSION['success'] = "";
    //                     header("location: Foodindex.php");
    //                 } else {
    //                     $_SESSION['error'] = "Data has not been inserted successfully";
    //                     header("location: Foodindex.php");
    //                 }
    // }elseif($numImages === 1){

    $maxFoods = 12; 
    $maxImg = 4;
    for ($i = 1; $i <= $maxFoods; $i++) {
        $ingredientsKey = 'ingredients' . $i;
        if (!empty($_POST[$ingredientsKey]) && empty($_POST['ingredients' . ($i + 1)])) {
            $sql = $conn->prepare("INSERT INTO food(ImgFood1,ImgFood2,ImgFood3,ImgFood4, FoodName, Detail,
            Ingredients0, Ingredients1, Ingredients2, Ingredients3, Ingredients4, Ingredients5, Ingredients6,
            Ingredients7, Ingredients8, Ingredients9, Ingredients10, Ingredients11, Ingredients12) 
            VALUES(:ImgFood1,:ImgFood2,:ImgFood3,:ImgFood4, :FoodName, :Detail, 
            :ingredients, :ingredients1, :ingredients2, :ingredients3, :ingredients4, :ingredients5, :ingredients6,
            :ingredients7, :ingredients8, :ingredients9, :ingredients10, :ingredients11, :ingredients12)");
            for ($g = 1; $g <= $maxImg; $g++) {
            for ($iii = 1; $iii <= $numImages; $iii++) {
                $ImgFood = 'ImgFood'.$iii;
                $sql->bindParam(":".$ImgFood, $images[$iii-1], PDO::PARAM_LOB);
            }
            for ($a = $g+1 ; $a <= $maxImg; $a++) {
                $ImgFood = 'ImgFood'.$a;
                $emptyValue = "";
                $sql->bindParam(":".$ImgFood,$emptyValue);
            }
            }
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
// }elseif($numImages === 2){

//     $maxFoods = 12; 
//     for ($i = 1; $i <= $maxFoods; $i++) {
//         $ingredientsKey = 'ingredients' . $i;
//         if (!empty($_POST[$ingredientsKey]) && empty($_POST['ingredients' . ($i + 1)])) {
//             $sql = $conn->prepare("INSERT INTO food(ImgFood1, ImgFood2, FoodName, Detail,
//             Ingredients0, Ingredients1, Ingredients2, Ingredients3, Ingredients4, Ingredients5, Ingredients6,
//             Ingredients7, Ingredients8, Ingredients9, Ingredients10, Ingredients11, Ingredients12) 
//             VALUES(:ImgFood1, :ImgFood2, :FoodName, :Detail, 
//             :ingredients, :ingredients1, :ingredients2, :ingredients3, :ingredients4, :ingredients5, :ingredients6,
//             :ingredients7, :ingredients8, :ingredients9, :ingredients10, :ingredients11, :ingredients12)");
//             $sql->bindParam(":ImgFood1", $images[0], PDO::PARAM_LOB);
//             $sql->bindParam(":ImgFood2", $images[1], PDO::PARAM_LOB);
//             $sql->bindParam(":FoodName", $foodName);
//             $sql->bindParam(":Detail", $detail);
//             $sql->bindParam(":ingredients", $_POST['ingredients']);
//             for ($j = 1; $j <= $i; $j++) {
//                 $ingredients = 'ingredients' . $j;
//                 $sql->bindParam(":" . $ingredients, $_POST[$ingredients]);
//             }
//             for ($j = $i + 1; $j <= $maxFoods; $j++) {
//                 $ingredients = 'ingredients' . $j;
//                 $emptyValue = "";
//                 $sql->bindParam(":" . $ingredients, $emptyValue);
//             }
//             $executeResult = $sql->execute();

//             if ($executeResult) {
//                 $_SESSION['success'] = "เพิ่มข้อมูลเรียบร้อย";
//             } else {
//                 $_SESSION['error'] = "Data has not been inserted successfully";
//             }
//             header("location: Foodindex.php");
//             break; // Break the loop after the insertion
//         }
//     }
// }
// elseif($numImages === 3){

//     $maxFoods = 12; 
//     for ($i = 1; $i <= $maxFoods; $i++) {
//         $ingredientsKey = 'ingredients' . $i;
//         if (!empty($_POST[$ingredientsKey]) && empty($_POST['ingredients' . ($i + 1)])) {
//             $sql = $conn->prepare("INSERT INTO food(ImgFood1, ImgFood2, FoodName, Detail,
//             Ingredients0, Ingredients1, Ingredients2, Ingredients3, Ingredients4, Ingredients5, Ingredients6,
//             Ingredients7, Ingredients8, Ingredients9, Ingredients10, Ingredients11, Ingredients12) 
//             VALUES(:ImgFood1, :ImgFood2, :FoodName, :Detail, 
//             :ingredients, :ingredients1, :ingredients2, :ingredients3, :ingredients4, :ingredients5, :ingredients6,
//             :ingredients7, :ingredients8, :ingredients9, :ingredients10, :ingredients11, :ingredients12)");
//             $sql->bindParam(":ImgFood1", $images[0], PDO::PARAM_LOB);
//             $sql->bindParam(":ImgFood2", $images[1], PDO::PARAM_LOB);
//             $sql->bindParam(":FoodName", $foodName);
//             $sql->bindParam(":Detail", $detail);
//             $sql->bindParam(":ingredients", $_POST['ingredients']);
//             for ($j = 1; $j <= $i; $j++) {
//                 $ingredients = 'ingredients' . $j;
//                 $sql->bindParam(":" . $ingredients, $_POST[$ingredients]);
//             }
//             for ($j = $i + 1; $j <= $maxFoods; $j++) {
//                 $ingredients = 'ingredients' . $j;
//                 $emptyValue = "";
//                 $sql->bindParam(":" . $ingredients, $emptyValue);
//             }
//             $executeResult = $sql->execute();

//             if ($executeResult) {
//                 $_SESSION['success'] = "เพิ่มข้อมูลเรียบร้อย";
//             } else {
//                 $_SESSION['error'] = "Data has not been inserted successfully";
//             }
//             header("location: Foodindex.php");
//             break; // Break the loop after the insertion
//         }
//     }
// }
// elseif($numImages === 4){

//     $maxFoods = 12; 
//     for ($i = 1; $i <= $maxFoods; $i++) {
//         $ingredientsKey = 'ingredients' . $i;
//         if (!empty($_POST[$ingredientsKey]) && empty($_POST['ingredients' . ($i + 1)])) {
//             $sql = $conn->prepare("INSERT INTO food(ImgFood1, ImgFood2, FoodName, Detail,
//             Ingredients0, Ingredients1, Ingredients2, Ingredients3, Ingredients4, Ingredients5, Ingredients6,
//             Ingredients7, Ingredients8, Ingredients9, Ingredients10, Ingredients11, Ingredients12) 
//             VALUES(:ImgFood1, :ImgFood2, :FoodName, :Detail, 
//             :ingredients, :ingredients1, :ingredients2, :ingredients3, :ingredients4, :ingredients5, :ingredients6,
//             :ingredients7, :ingredients8, :ingredients9, :ingredients10, :ingredients11, :ingredients12)");
//             $sql->bindParam(":ImgFood1", $images[0], PDO::PARAM_LOB);
//             $sql->bindParam(":ImgFood2", $images[1], PDO::PARAM_LOB);
//             $sql->bindParam(":FoodName", $foodName);
//             $sql->bindParam(":Detail", $detail);
//             $sql->bindParam(":ingredients", $_POST['ingredients']);
//             for ($j = 1; $j <= $i; $j++) {
//                 $ingredients = 'ingredients' . $j;
//                 $sql->bindParam(":" . $ingredients, $_POST[$ingredients]);
//             }
//             for ($j = $i + 1; $j <= $maxFoods; $j++) {
//                 $ingredients = 'ingredients' . $j;
//                 $emptyValue = "";
//                 $sql->bindParam(":" . $ingredients, $emptyValue);
//             }
//             $executeResult = $sql->execute();

//             if ($executeResult) {
//                 $_SESSION['success'] = "เพิ่มข้อมูลเรียบร้อย";
//             } else {
//                 $_SESSION['error'] = "Data has not been inserted successfully";
//             }
//             header("location: Foodindex.php");
//             break; // Break the loop after the insertion
//         }
//     }

}


?>