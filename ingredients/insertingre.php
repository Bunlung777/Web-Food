<?php

session_start();
include("../Config/DB.php");

if (isset($_POST['submitingre'])) {
    $ingreName = $_POST['Ingrename'];
    $img = file_get_contents($_FILES['imgIngre']['tmp_name']);

    $sql = $conn->prepare("INSERT INTO ingredients (ImgIngre, ingredientsName) VALUES (:ImgIngre, :ingredient)");
    $sql->bindParam(":ImgIngre", $img, PDO::PARAM_LOB);
    $sql->bindParam(":ingredient", $ingreName);
    $sql->execute();

    if ($sql) {
        $_SESSION['success'] = "";
        header("location: indexingre.php");
    } else {
        $_SESSION['error'] = "Data has not been inserted successfully";
        header("location: indexingre.php");
    }
}

?>
